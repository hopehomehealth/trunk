

(function($) {
	$.fn.validationEngineLanguage = function() {};
	$.validationEngineLanguage = {
		newLang: function() {
			$.validationEngineLanguage.allRules = 	{"required":{    			// Add your regex rules here, you can take telephone as an example
						"regex":"none",
						"alertText":"* ������",
						"alertTextCheckboxMultiple":"* ����ѡ��һ����Ŀ",
						"alertTextCheckboxe":"* ���빴ѡ"},
					"length":{
						"regex":"none",
						"alertText":"* �� ",
						"alertText2":" �� ",
						"alertText3": " ���ַ�֮��"},
					"maxCheckbox":{
						"regex":"none",
						"alertText":"* ��������"},	
					"minCheckbox":{
						"regex":"none",
						"alertText":"* ����ѡ�� ",
						"alertText2":" ��Ŀ"},	
					"confirm":{
						"regex":"none",
						"alertText":"* ���벻һ��"},		
					"telephone":{
						"regex":"/^[0-9\-\(\)\ ]+$/",
						"alertText":"* �����õĵ绰�����ʽ"},	
					"email":{
						"regex":"/^[a-zA-Z0-9_\.\-]+\@([a-zA-Z0-9\-]+\.)+[a-zA-Z0-9]{2,4}$/",
						"alertText":"* �����õĵ����ʼ���ʽ"},	
					"date":{
                         "regex":"/^[0-9]{4}\-\[0-9]{1,2}\-\[0-9]{1,2}$/",
                         "alertText":"* ���ڸ�ʽ����ȷ, ������� YYYY-MM-DD ��ʽ"},
					"onlyNumber":{
						"regex":"/^[0-9\ ]+$/",
						"alertText":"* ����������"},	
					"noSpecialCaracters":{
						"regex":"/^[0-9a-zA-Z]+$/",
						"alertText":"* ��������ĸ������"},	
					"ajaxUser":{
						"file":"validateUser.php",
						"extraData":"name=eric",
						"alertTextOk":"* This user is available",	
						"alertTextLoad":"* Loading, please wait",
						"alertText":"* This user is already taken"},	
					"ajaxName":{
						"file":"validateUser.php",
						"alertText":"* This name is already taken",
						"alertTextOk":"* This name is available",	
						"alertTextLoad":"* Loading, please wait"},		
					"onlyLetter":{
						"regex":"/^[a-zA-Z\ \']+$/",
						"alertText":"* ����ĸ"}
					}	
		}
	}
})(jQuery);

$(document).ready(function() {	
	$.validationEngineLanguage.newLang()
});