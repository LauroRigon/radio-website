const jConfirm = {
	confirm (message, callback) {
		var ConfirmBox = "<div class='divMessageBox animated fadeIn fast' id='MsgBoxBack'></div>";
		$('body').append(ConfirmBox);

		var Content = "<div class='MessageBoxContainer'>";
		Content += "<div class='MessageBoxMiddle'>";
		Content += "<p>" + message + "</p>";
		Content += "<button class='btn btn-success' value='1' style='margin-right:5px'>Confirmar" + "</button>";
		Content += "<button class='btn btn-danger' value='0'>Cancelar" + "</button>";
		Content += "</div></div>";

		$('.divMessageBox').append(Content);

		$('button').on('click', function(e){
			if(e.target.value == 1){
				if (typeof callback == "function") {
                    callback(e.target.value);
                    this.closeConfirm();
            	}
			}else{
				this.closeConfirm();
			}
		}.bind(this))
	},

	closeConfirm() {
		$("#MsgBoxBack").removeClass("fadeIn").addClass("fadeOut").delay(300).queue(function () {
            $(this).remove();
        });
	}
}

export default jConfirm