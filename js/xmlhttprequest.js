function getXmlHttpRequest() {
	//Для оперы, firefox'a, хрома
	if (window.XMLHttpRequest) { //Стандартная функция
		try {
			return new XMLHttpRequest();
		} 
		catch (e){}
	}
	//Для ie
	else if (window.ActiveXObject) {
		try {
			return new ActiveXObject('Msxml2.XMLHTTP'); // Поверка IE 5
		} 
		catch (e){}
		try {
			return new ActiveXObject('Microsoft.XMLHTTP'); // Провкерка IE 6
		} 
		catch (e){}
	}
	return null;
}
