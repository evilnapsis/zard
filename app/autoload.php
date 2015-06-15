<?php

include "core/Core.php";
include "core/View.php";
include "core/Module.php";
include "core/Database.php";
include "core/Executor.php";
//# include "core/Session.php"; [remplazada]

include "core/forms/lbForm.php";
include "core/forms/lbInputText.php";
include "core/forms/lbInputPassword.php";
include "core/forms/lbValidator.php";

// 10 octubre 2014
include "core/Model.php";
include "core/Bootload.php";
include "core/Action.php";

// 13 octubre 2014
include "core/Request.php";


// 14 octubre 2014
include "core/Get.php";
include "core/Post.php";
include "core/Cookie.php";
include "core/Session.php";
include "core/Lb.php";

// 26 diciembre 2014
include "core/Form.php";

// 24 marzo 2015
include "core/Controller.php";

// 14 junio 2015
include "core/class.upload.php";
include "core/Viewer.php";
include "core/IpLogger.php";

function __autoload($modelname){
	if(Model::exists($modelname)){
		include Model::getFullPath($modelname);
	}
}


?>