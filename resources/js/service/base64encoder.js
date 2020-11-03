export default class base64encoder {
   set(file){
   	this.file = file;
   }
   encoder(){
   	return new Promise((resolve, reject) => {
	    const reader = new FileReader();
	    reader.readAsDataURL(this.file);
	    reader.onload = () => resolve(reader.result);
	    reader.onerror = error => reject(error);
	  });
   }
}