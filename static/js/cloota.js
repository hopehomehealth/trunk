function loadimage(this_image, this_px){
	var src_w = this_image.width;
	var src_h = this_image.height;
		
	if(src_w>=src_h){
		if(this_image.width>this_px)  
			this_image.width=this_px;
	} else {
		if(this_image.height>this_px) 
			this_image.height=this_px;
	}
}  

function addfavorite() {
    try {
        window.external.addFavorite(location, document.title);
    }catch(e) {
        try {
            window.sidebar.addPanel(document.title, location, "");
        } catch(e) {
            alert("�����������֧�ִ��ղط�ʽ���밴Ctrl+D�ֶ��ղأ�");
        }
    }
}