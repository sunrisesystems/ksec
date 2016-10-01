//*************** CONFIG ***********************************//

//Not implemented yet.
var CONFIG = Array;
CONFIG['date_seperator'] = '-';
CONFIG['date_format'] = 0; //mm-dd-yyyy
CONFIG['time_seperator'] = ':';
CONFIG['time_format'] = 0; //hh:mm:ss




//*************** CONFIG ***********************************//



//Input : str (string)
//return type : string
//Desc : Remove white spaces from left side of input string.
function ltrim(str)
{
	return str.replace(/^\s+/, '');	
}


//Input : str (string)
//return type : string
//Desc : Remove white spaces from right side of input string.
function rtrim(str)
{	
	return str.replace(/\s+$/, '');
}

//Input : str (string)
//return type : string
//Desc : Remove white spaces from both side of input string.
function trim(str)
{
	a = ltrim(str);
	b = rtrim(a);
	return b;
}


//new function same as trim() added since the above function conflicts with other library func.
//Input : str (string)
//return type : string
//Desc : Remove white spaces from both side of input string.
function trimStr(str)
{

	a = ltrim(str);

	b = rtrim(a);

	return b;

}


//Input : str (string)
//return type : boolean
//Desc : returns true if i/p string is empty else false.
function isEmpty(str)
{
	trimmedStr = trimStr(str); 
	
	if(trimmedStr == '')
	{
		return true;
	}
	return false;
}

//Input : str (string) , allowWhiteSpace (string)
//return type : boolean
//Desc : If str is alphabetic , return true else return false.
// if allowWhiteSpace = true , then allow white space in input str.
function isAlpha( str , allowWhiteSpace  )
{
	if(isEmpty(str))
	{
		return false;
	}

	if(allowWhiteSpace)
	{
		return /^[a-zA-Z\s]+$/.test(str) ;
	}
	else
	{
		return /^[a-zA-Z]+$/.test(str) ;
	}
}


//Input : str (string) , allowWhiteSpace (string)
//return type : boolean
//Desc : If str is numeric , return true else return false.
// if allowWhiteSpace = true , then allow white space in input str.
function isNum( str , allowWhiteSpace )
{
	if(isEmpty(str))
	{
		return false;
	}

	if(allowWhiteSpace)
	{
		return /^[0-9\s]+$/.test(str) ;
	}
	else
	{
		return /^[0-9]+$/.test(str) ;
	}
}


//Input : str (string) , allowWhiteSpace (string)
//return type : boolean
//Desc : If str is alphanumeric , return true else return false.
// if allowWhiteSpace = true , then allow white space in input str.
function isAlphaNum( str , allowWhiteSpace )
{
	if(isEmpty(str))
	{
		return false;
	}

	if(allowWhiteSpace)
	{
		return /^[0-9a-zA-Z\s]+$/.test(str) ;
	}
	else
	{
		return /^[0-9a-zA-Z]+$/.test(str) ;
	}
}


//Input : str (string) 
//return type : boolean
//Desc : If str is float(positve or negative) , return true else return false.
function isFloat(str)
{
	trimmedStr = trimStr(str); 

	if(trimmedStr == '')
	{
		return false;
	}
	else if(trimmedStr == '.' || trimmedStr == '-' || trimmedStr == '+' )
	{
		return false;
	}
	
	
	result = /^[\+\-]?[0-9]*\.?[0-9]*$/.test(str);

	return result;
	
}


//Input : str (string) 
//return type : boolean
//Desc : If str is integer(positve or negative), return true else return false.
function isInt(str)
{
	if(isEmpty(str))
	{
		return false;
	}
	
	result = /^[\+\-]?[0-9]+$/.test(str);

	return result;
	
}


//Input : radioName (string) => Name of the radio element
//return type : boolean
//Desc : Returns true if a radio button is checked.
function IsRadioChecked(radioName)
{	

	var arrElem = document.getElementsByName(radioName);
	
	for(var i=0 ; i < arrElem.length ; i++ )
	{
		if(arrElem[i].checked == true)
		{
			return true;
		}
		
	}

	return false;
}


//Input : chkboxName (string) => name of check box element
//return type : boolean
//Desc : Returns true if any one check box button is checked.
function IsCheckBoxChecked(chkboxName)
{	

	var arrElem = document.getElementsByName(chkboxName);
	
	for(var i=0 ; i < arrElem.length ; i++ )
	{
		if(arrElem[i].checked == true)
		{
			return true;
		}
		
	}

	return false;
}


//Input : selectBoxId (string) => id of select box.
//return type : boolean
//Desc : Returns false if first element is selected.
function IsSelectBoxChecked(selectBoxId)
{
	var objSelect = document.getElementById(selectBoxId);
	if(objSelect.selectedIndex == 0)
	{
		return false;
	}
	else
	{
		return true;
	}
}

//added by supriya
function isValidEmail(email)
{
	result = /^[A-Za-z0-9_\+-]+(\.[A-Za-z0-9_\+-]+)*@[A-Za-z0-9-]+(\.){0,1}([A-Za-z0-9-]+)*\.([A-Za-z]{2,4})$/.test(email);
	return result;
}

//Input : email (string)
//return type : boolean
//Desc : Returns true if var email is a valid email id else return false.
function isValidEmail_old(email)
{
	// First, we check that there's one @ symbol, and that the lengths are right
	if (!/^[^@]{1,64}@[^@]{1,255}$/.test(email)) {
		// Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
		return false;
	}
	// Split it into sections.
	email_array = email.split('@');
	local_array = email_array[0].split('.');
	for (i = 0; i < local_array.length; i++) {
		if (! '/^(([A-Za-z0-9!$%&\'*+/=?^_`{|}~-][A-Za-z0-9!$%&\'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/'.test(local_array[i])) {
			return false;
		}
	}
	if (!/^\[?[0-9\.]+\]?$/.test(email_array[1])) {
		// Check if domain is IP. If not, it should be valid domain name
		domain_array = email_array[1].split('.');
		if (domain_array.length < 2) {
			return false; // Not enough parts to domain
		}
		for (i = 0; i < domain_array.length; i++) {
			if (!/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/.test(domain_array[i])) {
				return false;
			}
		}
	}
	return true;
}




//Input : strDate (string) , format (int)
//return : bool / Date Object
//Desc : forms date object and returns it.
/*
	format_code		format
		0			mm-dd-yyyy
		1			dd-mm-yyyy
*/
function getObjDate(strDate,format)
{
	strDate = trimStr(strDate);
	var dd = 0 ;
	var mm = 0;
	var yy = 0;

	//extract date , month and year from given date string.
	switch(format)
	{
		case 0:
			arrDate = strDate.split(CONFIG['date_seperator']); 
			dd = arrDate[1];
			mm = arrDate[0]-1;
			yy = arrDate[2];
			break;


		case 1:
			arrDate = strDate.split(CONFIG['date_seperator']);
                        dd = arrDate[0];
			mm = arrDate[1]-1;
			yy = arrDate[2];
			break;


		default :
			return false;			
	}


	//creating Date object
	var objDate = new Date();
	objDate.setDate(dd);
	objDate.setMonth(mm);
	objDate.setFullYear(yy);

	return objDate;
	
}


//Input : strTime (string) , format (int)
//return : bool / Date Object
//Desc : forms date object and returns it.
/*
	format_code		format
		0			hh:mm:ss		
*/
function getObjTime(strTime,format)
{
	strTime = trimStr(strTime);

	var hh,mm,ss;

	//extract hrs , mins and secs from given time string.
	switch(format)
	{
		case 0:
			arrDate = strTime.split(CONFIG['time_seperator']); 
			hh = arrDate[0];
			mm = arrDate[1];
			ss = arrDate[2];
			break;

		default :
			return false;			
	}


	//creating Date object
	var objDate = new Date();
	objDate.setHours(hh);
	objDate.setMinutes(mm);
	objDate.setSeconds(ss);

	return objDate;
	
}



//Input : strDate (string) , format (int)
//return : bool
//Desc : Returns true if date is a valid date else false.
/*
	format_code		format
		0			mm-dd-yyyy
		1			dd-mm-yyyy
*/
function isValidDate(strDate,format)
{
	strDate = trimStr(strDate);
	var dd = 0 ;
	var mm = 0;
	var yy = 0;

	//extract date , month and year from given date string.
	switch(format)
	{
		case 0:
			pattern = '^[0-9]{2}\\'+CONFIG['date_seperator']+'[0-9]{2}\\'+CONFIG['date_seperator']+'[0-9]{4}$';
			datePatt = new RegExp(pattern,'');
			//if(/^[0-9]{2}\-[0-9]{2}\-[0-9]{4}$/.test(strDate))
			if(datePatt.test(strDate))
			{
				arrDate = strDate.split(CONFIG['date_seperator']); 
				dd = arrDate[1];
				mm = arrDate[0];
				yy = arrDate[2];
			}
			else
			{
				return false;
			}
			break;


		case 1:
			pattern = '^[0-9]{2}\\'+CONFIG['date_seperator']+'[0-9]{2}\\'+CONFIG['date_seperator']+'[0-9]{4}$';
			if(pattern.test(strDate))
			{
				arrDate = strDate.split(CONFIG['date_seperator']); 
				dd = arrDate[0];
				mm = arrDate[1];
				yy = arrDate[2];
			}
			else
			{
				return false;
			}
			break;


		default :
			return false;
			
	}



	//validating date
	//no of days in each month.
	var day = new Array(31,28,31,30,31,30,31,31,30,31,30,31);	

	if (yy < 100) yy += 2000;
	if (yy < 1582 || yy > 4881) return false;
	if (mm == 2 && (yy%400 == 0 || (yy%4 == 0 && yy%100 != 0))) day[1]=29;else day[1]=28;
	if (mm < 1 || mm > 12) return false;
	if (dd < 1 || dd > day[mm-1]) return false;

	return true;

	


}



//Input : strTime (string) , format (int)
//return : bool
//Desc : Returns true if time is valid else false.
/*
	format_code		format
		0			hh:mm:ss		
*/
function isValidTime(strTime,format)
{	

	strTime = trimStr(strTime);

	var hh,mm,ss ;
	

	//extract hours , mins and secs from given time string.
	switch(format)
	{
		case 0:
			pattern = '^[0-9]{2}\\'+CONFIG['time_seperator']+'[0-9]{2}\\'+CONFIG['time_seperator']+'[0-9]{2}$';
			timePatt = new RegExp(pattern,'');
			
			if(timePatt.test(strTime))
			{
				arrTime = strTime.split(CONFIG['time_seperator']); 
				hh = arrTime[1];
				mm = arrTime[0];
				ss = arrTime[2];
			}
			else
			{
				return false;
			}
			break;		

		default :
			return false;
			
	}



	if(hh >= 24 || mm >= 60 || ss >=60 )
	{
		return false;
	}

	return true;

}


var lib_show_single_error = true;
function validate( objForm , arrElemId , arrCode , arrRefValue , arrMsg )
{
	var final_result = true;
	var total = arrElemId.length ;
 
	for(var i=0 ; i < total ; i++)
	{
		id = arrElemId[i];
		value = document.getElementById(id).value ;
		code = arrCode[i];
		msg = arrMsg[i];
		refValue = arrRefValue[i];
		result = true;
		switch(code)
		{
			case 'IS_EMPTY':				
				value = document.getElementById(id).value ;
				
				if(isEmpty(value) === true)
				{
					result = false;
				}
				break;


			case 'ALPHA':
				value = document.getElementById(id).value ;	
				// Bypass validation for empty values.
				if(!isEmpty(value))
				{						
					result = isAlpha(value,false);	
				}
				break;


			case 'ALPHA_S':
				value = document.getElementById(id).value ;
				if(!isEmpty(value))
				{	
					result = isAlpha(value,true);	
				}
				break;


			case 'NUM':
				value = document.getElementById(id).value ;
				if(!isEmpty(value))
				{	
					result = isNum(value,false);
				}
				break;


			case 'NUM_S':
				value = document.getElementById(id).value ;
				if(!isEmpty(value))
				{	
					result = isNum(value,true);
				}
				break;


			case 'ALPHANUM':
				value = document.getElementById(id).value ;
				if(!isEmpty(value))
				{	
					result = isAlphaNum(value,false);
				}
				break;


			case 'ALPHANUM_S':
				value = document.getElementById(id).value ;
				if(!isEmpty(value))
				{	
					result = isAlphaNum(value,true);
				}
				break;


			case 'INT':
				value = document.getElementById(id).value ;
				if(!isEmpty(value))
				{	
					result = isInt(value);
				}
				break;


			case 'FLOAT':
				value = document.getElementById(id).value ;
				if(!isEmpty(value))
				{	
					result = isFloat(value);
				}
				break;

			
			case 'EMAIL':
				value = document.getElementById(id).value ;
				if(!isEmpty(value))
				{	
					result = isValidEmail(value);
				}
				break;


			case 'MOBILE':
				value = document.getElementById(id).value ;
				if(!isEmpty(value))
				{	
					result = /^[987][0-9]{9}$/.test(value);
					// result = /^0?[0-9]{9}$/.test(value);
				}
				break;
                                    
                        case 'LANDLINE':
				value = document.getElementById(id).value ;
                                //alert(111);
				if(!isEmpty(value))
				{	
					result = /^[0]{1}[1-9]{2,4}\-[1-9]{1}[0-9]{5,7}$/.test(value);
					// result = /^0?[0-9]{9}$/.test(value);
                                  //      alert(result);
				}
				break; 
			
			case 'REGEX':
				value = document.getElementById(id).value ;
				if(!isEmpty(value))
				{	
					result = refValue.test(value);
				}
				break;


			case 'NREGEX':
				value = document.getElementById(id).value ;
				if(!isEmpty(value))
				{	
					result = !refValue.test(value);
				}
				break;


			case 'VALUE_SET':
				value = document.getElementById(id).value ;
				if(!isEmpty(value))
				{	
					result = inArray(value,refValue);
				}
				break;


			case 'N_VALUE_SET':
				value = document.getElementById(id).value ;
				if(!isEmpty(value))
				{	
					result = !inArray(value,refValue);
				}
				break;


			case 'GREATER':
				value = document.getElementById(id).value;
				if(!isEmpty(value))
				{
					if(value > refValue)
					{
						result = true;
					}
					else
					{
						result = false;
					}
				}
				break;


			case 'LESSER':
				value = document.getElementById(id).value;
				
				if(!isEmpty(value))
				{
					if(value.length < refValue)
					{
						result = true;
					}
					else
					{
						result = false;
					}
				}
				break;

			case 'LESSER_EQUAL':
				value = document.getElementById(id).value;
				if(!isEmpty(value))
				{
					if(value.length <= refValue)
					{
						result = true;
					}
					else
					{
						result = false;
					}
				}
				break;

			case 'EQUAL':
				value = document.getElementById(id).value ;
				if(!isEmpty(value))
				{
					if(value == refValue)
					{
						result = true;
					}
					else
					{
						result = false;
					}
				}
				break;
			case 'EQUAL_LENGTH':
				value = document.getElementById(id).value ;
				if(!isEmpty(value))
				{
					if(value.length == refValue)
					{
						result = true;
					}
					else
					{
						result = false;
					}
				}
				break;

            case 'EQUAL_VAL':
                value = document.getElementById(id).value ;
                if(!isEmpty(value))
                {
                    if(value == refValue)
                    {
                        result = true;
                    }
                    else
                    {
                        result = false;
                    }
                }
                break;


			case 'NEQUAL':
				value = document.getElementById(id).value ;
				if(!isEmpty(value))
				{
					if(value != refValue)
					{
						result = true;
					}
					else
					{
						result = false;
					}
				}
				break;


			case 'BETWEEN':
				value = document.getElementById(id).value ;
				if(!isEmpty(value))
				{
					arrLimit = refValue.split('#');
					min = arrLimit[0];
					max = arrLimit[1];

					if(min <= value && value <= max )
					{
						result = true;
					}
					else
					{
						result = false;
					}
				}
				break;


			case 'NBETWEEN':
				value = document.getElementById(id).value ;
				if(!isEmpty(value))
				{
					arrLimit = refValue.split('#');
					min = arrLimit[0];
					max = arrLimit[1];

					if(min <= value && value <= max )
					{
						result = false;
					}
					else
					{
						result = true;
					}
				}
				break;


			case 'LENGTH_GREATER':
				value = document.getElementById(id).value ;
				
				if(!isEmpty(value))
				{
					txtLen = value.length;
					if(txtLen > refValue)
					{
						result = true;
					}
					else
					{
						result = false;
					}
				}
				break;

			case 'LENGTH_GREATER_EQUAL':
				value = document.getElementById(id).value ;
				
				if(!isEmpty(value))
				{
					txtLen = value.length;
					if(txtLen >= refValue)
					{
						result = true;
					}
					else
					{
						result = false;
					}
				}
				break;


			case 'LENGTH_LESSER':
				value = document.getElementById(id).value ;
				
				if(!isEmpty(value))
				{
					txtLen = value.length;

					if(txtLen < refValue)
					{
						result = true;
					}
					else
					{
						result = false;
					}
				}
				break;

			case 'LENGTH_LESSER_EQUAL':
				value = document.getElementById(id).value ;
				
				if(!isEmpty(value))
				{
					txtLen = value.length;

					if(txtLen <= refValue)
					{
						result = true;
					}
					else
					{
						result = false;
					}
				}
				break;


			case 'LENGTH_EQUAL':
				value = document.getElementById(id).value ;
				/*alert(value);*/
				if(!isEmpty(value))
				{
					txtLen = value.length;
					/*alert(txtLen);
					alert("ref value==>"+refValue);*/
					if(txtLen == refValue)
					{
						result = true;
					}
					else
					{
						result = false;
					}
				}
				//alert(result);
				break;


			case 'LENGTH_NEQUAL':
				value = document.getElementById(id).value ;
				
				if(!isEmpty(value))
				{
					txtLen = value.length;

					if(txtLen != refValue)
					{
						result = true;
					}
					else
					{
						result = false;
					}
				}
				break;


			case 'DATE'://assuming mm-dd-yyyy fmt.
				value = document.getElementById(id).value ;
				
				if(!isEmpty(value))
				{					
					if(isValidDate(value,0))
					{
						result = true;
					}
					else
					{
						result = false;
					}
				}
				break;

                        // added by supriya for checking date greater or equal
			case 'DATE_GREATER_OR_EQUAL':
				value = document.getElementById(id).value ;
				
				if(!isEmpty(value))
				{
					// to get date in dd-mm-yyyy format, second param of getObjDate is set to 1 
					objDate1 = getObjDate(value,1);
					objDate2 = getObjDate(refValue,1);
					//alert(objDate1);
					//alert(objDate2);
					if(!objDate1 || !objDate2)
					{
						result = false;
					}
					else
					{

						timestamp1 = objDate1.valueOf();
						timestamp2 = objDate2.valueOf();
						
						if(timestamp1 >= timestamp2)
						{
							result = true;
						}
						else
						{
							result = false;
						}
					}
				}
				break;
                                
                         case 'DATE_LESSER_OR_EQUAL':
				value = document.getElementById(id).value ;
			//	alert(value);
				if(!isEmpty(value))
				{					
					objDate1 = getObjDate(value,1);
					objDate2 = getObjDate(refValue,1);
                                        if(!objDate1 || !objDate2)
					{
						result = false;
					}
					else
					{
                                                
						timestamp1 = objDate1.valueOf();
						timestamp2 = objDate2.valueOf();
						if(timestamp1 <= timestamp2)
						{
							result = true;
						}
						else
						{
							result = false;
						}
					}
				}
				break;          
                                
			case 'DATE_GREATER':
				value = document.getElementById(id).value ;
				
				if(!isEmpty(value))
				{
					// to get date in dd-mm-yyyy format, second param of getObjDate is set to 1 
					objDate1 = getObjDate(value,1);
					objDate2 = getObjDate(refValue,1);
					//alert(objDate1);
					//alert(objDate2);
					if(!objDate1 || !objDate2)
					{
						result = false;
					}
					else
					{

						timestamp1 = objDate1.valueOf();
						timestamp2 = objDate2.valueOf();
						
						if(timestamp1 > timestamp2)
						{
							result = true;
						}
						else
						{
							result = false;
						}
					}
				}
				break;


			case 'DATE_LESSER':
				value = document.getElementById(id).value ;
				
				if(!isEmpty(value))
				{					
					objDate1 = getObjDate(value,1);
					objDate2 = getObjDate(refValue,1);
                                        if(!objDate1 || !objDate2)
					{
						result = false;
					}
					else
					{

						timestamp1 = objDate1.valueOf();
						timestamp2 = objDate2.valueOf();
						
						if(timestamp1 < timestamp2)
						{
							result = true;
						}
						else
						{
							result = false;
						}
					}
				}
				break;


			case 'DATE_EQUAL':
				value = document.getElementById(id).value ;
				
				if(!isEmpty(value))
				{					
					objDate1 = getObjDate(value,1);
					objDate2 = getObjDate(refValue,1);

					if(!objDate1 || !objDate2)
					{
						result = false;
					}
					else
					{

						timestamp1 = objDate1.valueOf();
						timestamp2 = objDate2.valueOf();
						
						if(timestamp1 == timestamp2)
						{
							result = true;
						}
						else
						{
							result = false;
						}
					}
				}
				break;


			case 'DATE_NEQUAL':
				value = document.getElementById(id).value ;
				
				if(!isEmpty(value))
				{					
					objDate1 = getObjDate(value,1);
					objDate2 = getObjDate(refValue,1);

					if(!objDate1 || !objDate2)
					{
						result = false;
					}
					else
					{

						timestamp1 = objDate1.valueOf();
						timestamp2 = objDate2.valueOf();
						
						if(timestamp1 != timestamp2)
						{
							result = true;
						}
						else
						{
							result = false;
						}
					}
				}
				break;


			case 'DATE_BETWEEN':
				value = document.getElementById(id).value ;
				
				if(!isEmpty(value))
				{
					arrLimit = refValue.split('#');
					minDate = arrLimit[0];
					maxDate = arrLimit[1];

					
					objDate1 = getObjDate(value,1);
					objDate2 = getObjDate(minDate,1);
					objDate3 = getObjDate(maxDate,1);

					if(!objDate1 || !objDate2 || !objDate3)
					{
						result = false;
					}
					else
					{

						timestamp1 = objDate1.valueOf();
						timestamp2 = objDate2.valueOf();
						timestamp3 = objDate3.valueOf();
						
						if(timestamp2 <= timestamp1 && timestamp1 <= timestamp3 )
						{
							result = true;
						}
						else
						{
							result = false;
						}
					}
				}
				break;


			case 'DATE_NBETWEEN':
				value = document.getElementById(id).value ;
				
				if(!isEmpty(value))
				{
					arrLimit = refValue.split('#');
					minDate = arrLimit[0];
					maxDate = arrLimit[1];

					
					objDate1 = getObjDate(value,1);
					objDate2 = getObjDate(minDate,1);
					objDate3 = getObjDate(maxDate,1);

					if(!objDate1 || !objDate2 || !objDate3)
					{
						result = false;
					}
					else
					{

						timestamp1 = objDate1.valueOf();
						timestamp2 = objDate2.valueOf();
						timestamp3 = objDate3.valueOf();
						
						if(timestamp2 <= timestamp1 && timestamp1 <= timestamp3 )
						{
							result = false;
						}
						else
						{
							result = true;
						}
					}
				}
				break;



			case 'TIME'://assuming hh:mm:ss fmt.
				value = document.getElementById(id).value ;
				
				if(!isEmpty(value))
				{					
					if(isValidTime(value,0))
					{
						result = true;
					}
					else
					{
						result = false;
					}
				}
				break;



			case 'TIME_GREATER':
				value = document.getElementById(id).value ;
				
				if(!isEmpty(value))
				{					
					objDate1 = getObjTime(value,0);
					objDate2 = getObjTime(refValue,0);

					if(!objDate1 || !objDate2)
					{
						result = false;
					}
					else
					{

						timestamp1 = objDate1.valueOf();
						timestamp2 = objDate2.valueOf();
						
						if(timestamp1 > timestamp2)
						{
							result = true;
						}
						else
						{
							result = false;
						}
					}
				}
				break;


			case 'TIME_LESSER':
				value = document.getElementById(id).value ;
				
				if(!isEmpty(value))
				{					
					objDate1 = getObjTime(value,0);
					objDate2 = getObjTime(refValue,0);

					if(!objDate1 || !objDate2)
					{
						result = false;
					}
					else
					{

						timestamp1 = objDate1.valueOf();
						timestamp2 = objDate2.valueOf();
						
						if(timestamp1 < timestamp2)
						{
							result = true;
						}
						else
						{
							result = false;
						}
					}
				}
				break;


			case 'TIME_EQUAL':
				value = document.getElementById(id).value ;
				
				if(!isEmpty(value))
				{					
					objDate1 = getObjTime(value,0);
					objDate2 = getObjTime(refValue,0);

					if(!objDate1 || !objDate2)
					{
						result = false;
					}
					else
					{

						timestamp1 = objDate1.valueOf();
						timestamp2 = objDate2.valueOf();
						
						if(timestamp1 == timestamp2)
						{
							result = true;
						}
						else
						{
							result = false;
						}
					}
				}
				break;


			case 'TIME_NEQUAL':
				value = document.getElementById(id).value ;
				
				if(!isEmpty(value))
				{					
					objDate1 = getObjTime(value,0);
					objDate2 = getObjTime(refValue,0);

					if(!objDate1 || !objDate2)
					{
						result = false;
					}
					else
					{

						timestamp1 = objDate1.valueOf();
						timestamp2 = objDate2.valueOf();
						
						if(timestamp1 != timestamp2)
						{
							result = true;
						}
						else
						{
							result = false;
						}
					}
				}
				break;


			case 'TIME_BETWEEN':
				value = document.getElementById(id).value ;
				
				if(!isEmpty(value))
				{
					arrLimit = refValue.split('#');
					minDate = arrLimit[0];
					maxDate = arrLimit[1];

					
					objDate1 = getObjTime(value,0);
					objDate2 = getObjTime(minDate,0);
					objDate3 = getObjTime(maxDate,0);

					if(!objDate1 || !objDate2 || !objDate3)
					{
						result = false;
					}
					else
					{

						timestamp1 = objDate1.valueOf();
						timestamp2 = objDate2.valueOf();
						timestamp3 = objDate3.valueOf();
						
						if(timestamp2 <= timestamp1 && timestamp1 <= timestamp3 )
						{
							result = true;
						}
						else
						{
							result = false;
						}
					}
				}
				break;



			case 'TIME_NBETWEEN':
				value = document.getElementById(id).value ;
				
				if(!isEmpty(value))
				{
					arrLimit = refValue.split('#');
					minDate = arrLimit[0];
					maxDate = arrLimit[1];

					
					objDate1 = getObjTime(value,0);
					objDate2 = getObjTime(minDate,0);
					objDate3 = getObjTime(maxDate,0);

					if(!objDate1 || !objDate2 || !objDate3)
					{
						result = false;
					}
					else
					{

						timestamp1 = objDate1.valueOf();
						timestamp2 = objDate2.valueOf();
						timestamp3 = objDate3.valueOf();
						
						if(timestamp2 <= timestamp1 && timestamp1 <= timestamp3 )
						{
							result = false;
						}
						else
						{
							result = true;
						}
					}
				}
				break;




			
			case 'RADIO_BUTTON':
				result = IsRadioChecked(id);												
				break;


			case 'CHKBOX':
				result = IsCheckBoxChecked(id);												
				break;			
				

			case 'SELECTBOX':
				result = IsSelectBoxChecked(id);												
				break;		
			
			
				
			default:
				result = false;
				break;
				
				
		} // end of switch.


		if(result === false)
		{
			final_result = false;

			//display the error message in corresponding element div.
			
			alertDivId = id+'_alert';
		
			document.getElementById(alertDivId).style.display = 'block';
		
			document.getElementById(alertDivId).innerHTML = msg;
			var classname = document.getElementById(id).className;
			if(code!='RADIO_BUTTON' &&(classname != 'dateTxtBox') && (classname != 'input-xlarge datepicker hasDatepicker') &&(classname != 'innerSearchTxtBox dateTxtBox') && (classname != "input-xlarge hasDatepicker"))
			{ 
				document.getElementById(id).focus();
			}
			else
			{
				document.getElementById(alertDivId).focus();
			}
			
			if(lib_show_single_error == true)
			{
				return false;
				break;
			}
		}

	}//end of for loop

	return final_result;
}




//************************************************************************************************
//************************************************************************************************

//Input : arrData (array) 
//Return : int
//Desc : returns the size of an input associative or nonassociative array. 
function getArraySize(arrData) 
{
	var l = 0;
	
	for (var k in arrData) 
	{
		l++;
	}
	return l;
}


//Input : arrData (array) , search (mixed)
//Return : bool
//Desc : returns true if search element is present in array else returns false. 
function inArray(search,arrData) 
{	
	
	for (var k in arrData) 
	{
		if(search == arrData[k])
		{
			return k;
		}
	}

	return false;
}


//Input : arrData (array) , search (mixed)
//Return : array
//Desc : returns array key corresponding to value that matches search element.
function getArrayKeys(arrData,search) 
{
	var j = 0 ;
	var key = Array();
	for (var k in arrData) 
	{
		if(search == arrData[k])
		{
			key[j++] = k;
		}
	}

	return key;
}



function generateRandomNumber()
{
	num = Math.random();
	return num;
}


//pass event object to this function. Eg : onclick="isEnter(event)"
function isEnterKey(evt)
{
  var charCode = (evt.which) ? evt.which : event.keyCode
  // if not a digit or arrow key abort
  if ( charCode == 13) {
		return true
  } else {
		return false
  }
}


//clears all the alert msg set in the div
//call this function before calling validation function.
function clearAlertMsg()
{
	var divArr = document.getElementsByTagName("div");

	for(var i=0 ; i < divArr.length ; i++ )
	{
		if(divArr[i].id.indexOf("_alert") != -1)
		{
			divArr[i].innerHTML = "";
			divArr[i].style.display = 'none';
		}
	}
}
