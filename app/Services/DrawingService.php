<?php namespace ksec\Services;

use ksec\Drawing;
use ksec\DrawingAttachment;
use ksec\BlowCondition;
use ksec\PreformCondition;
use ksec\Shape;
use ksec\NeckSize;
use ksec\Type;
use ksec\Unit;
use ksec\Account;
use ksec\Product;
use ksec\Mold;
use Request,Config,DB,Validator,Lang,File;
use ksec\Libraries\Lib;

class DrawingService {

    public function __construct(Drawing $drawing,
    							BlowCondition $blowCondition,
    							PreformCondition $preformCondition,
    							Shape $shape,
    							NeckSize $neckSize,
    							Type $type,
                                DrawingAttachment $drawingAttachment,
                                Unit $unit,
                                Account $account,
                                Mold $mold,
                                Product $product)
    {
        $this->drawing = $drawing;
        $this->product = $product;
        $this->mold = $mold;
        $this->unit = $unit;
        $this->blowCondition = $blowCondition;
        $this->preformCondition = $preformCondition;
        $this->shape = $shape;
        $this->neckSize = $neckSize;
        $this->type = $type;
        $this->drawingAttachment = $drawingAttachment;
        $this->account = $account;
	}

    public function saveDrawing($input,$imageData)
    {  
        try {
            DB::beginTransaction();
            unset($input['drawing_file']);
            unset($input['attachments']);

            $input['mold_trade_name'] = $this->generateMoldTradeName($input);
            $insert = $this->drawing->saveDrawing($input);
            /* upload drawing_file */
            if(!empty($imageData['drawingFile'])){
                $fileName = Lib::uploadImage($imageData['drawingFile'],Config::get('global_vars.PRODUCT_TYPE.DRAWING_PRODUCT_TYPE'),$insert->id,[],'D_'.$insert->id);
                $update['drawing_file'] = $fileName;
                $updateSucc = $this->drawing->updateDrawing($update,$insert->id);
                if($updateSucc){
                    unset($update);
                    /* upload attachments */
                    if(!empty($imageData['attachments'])){
                        $rules = [
                            'attachment'=> 'required|mimes:jpeg,bmp,png,pdf'
                        ];
                        foreach ($imageData['attachments'] as $key => $value) {
                            $validation = Validator::make(['attachment'=>$value],$rules);
                            if($validation->passes()){
                                $data = [];
                                $data['drawing_id'] = $insert->id;
                                $data['file_name'] = 'null';
                                $drawingAtt = $this->drawingAttachment->saveAttachment($data);
                                $fileName = Lib::uploadImage($value,Config::get('global_vars.PRODUCT_TYPE.DRAWING_ATTACHMENT_PRODUCT_TYPE'),$insert->id,[],'DA_'.$drawingAtt->id);
                                $update = [];
                                $update['file_name'] = $fileName;
                                $updateSucc = $this->drawingAttachment->updateAttachment($update,$drawingAtt->id);
                            }
                        }
                        DB::commit();
                    }else{
                        DB::commit();
                    }
                }else{
                    DB::rollback();
                    return false;
                }
            }
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
        return true;
    }

    public function updateDrawing($input,$imageData,$id)
    {
        try {
            unset($input['drawingFile']);
            unset($input['attachments']);
            DB::beginTransaction();
            if(!empty($imageData['drawingFile'])){
                $fileName = Lib::uploadImage($imageData['drawingFile'],Config::get('global_vars.PRODUCT_TYPE.DRAWING_PRODUCT_TYPE'),$id,[],'D_'.$id);
                $input['drawing_file'] = $fileName;
            }
            $input['mold_trade_name'] = $this->generateMoldTradeName($input);
            $updateSucc = $this->drawing->updateDrawing($input,$id);
            if($updateSucc){
                if(!empty($imageData['attachments'])){
                    $rules = [
                        'attachment'=> 'required|mimes:jpeg,bmp,png,pdf'
                    ];
                    foreach ($imageData['attachments'] as $key => $value) {
                        $validation = Validator::make(['attachment'=>$value],$rules);
                        if($validation->passes()){
                            $data = [];
                            $data['drawing_id'] = $id;
                            $data['file_name'] = 'null';
                            $drawingAtt = $this->drawingAttachment->saveAttachment($data);
                            $fileName = Lib::uploadImage($value,Config::get('global_vars.PRODUCT_TYPE.DRAWING_ATTACHMENT_PRODUCT_TYPE'),$id,[],'DA_'.$drawingAtt->id);
                            $update = [];
                            $update['file_name'] = $fileName;
                            $updateSucc = $this->drawingAttachment->updateAttachment($update,$drawingAtt->id);
                        }
                    }
                }
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
        return true;
    }

    public function getAllData()
    {
    	$data = [];
    	$data['blowCondition'] = Lib::addSelect($this->blowCondition->getBlowConditionList());	
    	$data['preformCondition'] = Lib::addSelect($this->preformCondition->getPreformConditionList());
    	$data['shape'] = Lib::addSelect($this->shape->getShapeList());
    	$data['neckSize'] = Lib::addSelect($this->neckSize->getNeckSizeList());
    	$data['type'] = Lib::addSelect($this->type->getTypeListByGroupId(Config::get('global_vars.HARD_CODED_ID.NECK_GROUP_ID')));
        $data['units'] = Lib::addSelect($this->account->getVendorTypeAccountList());
        $data['status'] = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));
        
    	return $data;
    }

    public function getAllDataForIndex()
    {
        $data = [];
        $data['shape'] = Lib::addSelect($this->shape->getShapeList());
        $data['status'] = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));
        return $data;
    }
    public function getDrawings($input)
    {
        $input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
    	$data = $this->drawing->getDrawings($input);
    	return $data;
    }

    public function getDrawingById($id)
    {
        return $this->drawing->getDrawingById($id);
    }

    public function getDrawingAttachmentsByDrawingId($drawingId)
    {
        return $this->drawingAttachment->getByDrawingId($drawingId);
    }

    public function deleteDrawing($id)
    {
        $result = [
            'success' => 0,
            'msg' => Lang::get("messages.ERROR"),
        ];
        try {
            /* dependancy check */
            $deleteAllow = $this->checkDeleteDependancy($id);
            if($deleteAllow){
                DB::beginTransaction();
                /*delete drawing */
                /* delete drawing attachments first */
                $this->drawingAttachment->deleteByDrawingId($id);
                Lib::deleteImageByProduct(Config::get('global_vars.PRODUCT_TYPE.DRAWING_ATTACHMENT_PRODUCT_TYPE'),$id);
                Lib::deleteImageByProduct(Config::get('global_vars.PRODUCT_TYPE.DRAWING_PRODUCT_TYPE'),$id);

                $this->drawing->deleteById($id);

                DB::commit();
                $result['success'] = 1;
            }else{
                $result['msg'] = Lang::get("messages.delete_error");
            }
            
        } catch (Exception $e) {
            DB::rollback();
        }
        return $result;
    }
    
    /* example - 60 ml, Rd, 10.0-25 Ropp (FPC,shape code,drawing wt, neck size,neck type) */
    public function generateMoldTradeName($input){
        $name = Lib::roundOffNumber($input['fpc_c'],1)." ml, ";
        /* fetch share code */
        $shapeCode = $this->shape->getShapeCode($input['bottle_shape_id']);
        $name .= $shapeCode.", ".$input['drawing_wt_c']."-";

        /* fetch neck size and neck type */
        $neckSize = $this->neckSize->getNameById($input['neck_size_id']);
        $name .= $neckSize." ";

        $neckType = $this->type->getNameById($input['neck_type_id']);
        $name .= $neckType;
        
        return $name;
    }  


    public function getMoldTradeName($drawingId)
    {
        $response = [
            'success' => 0,
            'data' => Lang::get ( 'messages.PROCESS_FAIL' ) 
        ];
        try {
            $response['success'] = 1;
             $response['data'] =  $this->drawing->getMoldTradeNameById($drawingId);
       } catch (Exception $e) {
           $response['data'] = "DrawingService::getMoldTradeName ".$e->getMessage();
       }   
        return $response;
    }  

    public function checkDeleteDependancy($drawingId)
    {
        $moldCount = $this->mold->getMoldCountByDrawingId($drawingId);
        if($moldCount){
            return false;
        }
        $productCount = $this->product->getProductByDrawingId($drawingId);
        if($productCount){
            return false;
        }

        return true;

    }  

    public function checkDependancyForAccount($manufacturerId)
    {
        return $this->drawing->checkByAccount($manufacturerId);   
    } 

    public function checkDependancyForType($typeId)
    {
        return $this->drawing->cheeckByNeckType($typeId);
    } 

    public function checkDependancyForNeckSize($necksizeId)
    {
        return $this->drawing->checkByNecksize($necksizeId);            
    } 

    public function getDataForExcel()
    {
        $data = [];
        $drawings = $this->drawing->getAllDrawings();
        if(!empty($drawings)){
            $supportData = $this->getAllData();
            $keys = [ 'Id','Drawing No', 'Mold Trade Name','Preform Condition','Blow Condition','Std Cycle Time Low','Std Cycle Time Center','Std Cycle Time High','Std Cavities','Std Cavitiy Blocks','Std Weight Low','Std Weight Center','Std Weight High','Drawing Weight Low','Drawing Weight Center','Drawing Weight High','Min Wall Thickness','Avg Wall Thickness','Body Diameter Low','Body Diameter Center','Body Diameter High','Product Height Low','Product Height Center','Product Height High','Overflow Capacity Low','Overflow Capacity Center','Overflow Capacity High','Fill Point Capacity Low','Fill Point Capacity Center','Fill Point Capacity High','Neck Height Low','Neck Height Center','Neck Height High','Bottle Shape','Neck Size','Neck Type','Num Of Thread Turns','Std Purging','Std Rejection','Manufacturer','Status'
            ];
            array_push($data, $keys);
            
            foreach ($drawings as $key => $value) {
                unset($value['created_at']);
                unset($value['updated_at']);
                unset($value['deleted_at']);
                unset($value['drawing_file']);
                $value['status'] = $supportData['status'][$value['status']];
                $value['preform_condition_id'] = @$supportData['preformCondition'][$value['preform_condition_id']];
                $value['blow_condition_id'] = @$supportData['blowCondition'][$value['blow_condition_id']];
                $value['bottle_shape_id'] = @$supportData['shape'][$value['bottle_shape_id']];
                $value['neck_size_id'] = @$supportData['neckSize'][$value['neck_size_id']];
                $value['neck_type_id'] = @$supportData['type'][$value['neck_type_id']];
                $value['manufacturer_id'] = @$supportData['units'][$value['manufacturer_id']];
                array_push($data, $value);
            }
        }
        return $data;
        
    } 

    public function deleteAttachment($attachmentId)
    {
        $result = [
            'success' => 0,
            'data' => Lang::get('messages.ERROR'),
        ];
        try {
            // get attachment record first
            $attachment = $this->drawingAttachment->getById($attachmentId);
            if(count($attachment)){
                // delete attachment from table
                DB::beginTransaction();
                $delete = $this->drawingAttachment->deleteById($attachmentId);
                $filename = 'DA_'.$attachmentId.'.pdf';
                $drawingId = $attachment->drawing_id;

                $filePath = public_path().'/data/'.Config::get('global_vars.PRODUCT_TYPE.DRAWING_ATTACHMENT_PRODUCT_TYPE').'/'.$drawingId.'/'.$filename;
                if(File::exists($filePath)){
                    File::delete($filePath);
                    DB::commit();
                    $result['success'] = 1;
                    unset($result['data']);
                }else{
                    DB::rollback();
                }
            }
        } catch (Exception $e) {
            DB::rollback();
            $result['data'] = "DrawingService::deleteAttachment ".$e->getMessage();
        }
        return $result;
    }   
}