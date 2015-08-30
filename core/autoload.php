<?php
/**
* @author evilnapsis
* @brief Llama todos los archivos del framework LegoBox
**/

include "admin/core/controller/Core.php";
include "admin/core/controller/View.php";
include "admin/core/controller/Module.php";
include "admin/core/controller/Database.php";
include "admin/core/controller/Executor.php";
//# include "admin/core/controller/Session.php"; [remplazada]

include "admin/core/controller/forms/lbForm.php";
include "admin/core/controller/forms/lbInputText.php";
include "admin/core/controller/forms/lbInputPassword.php";
include "admin/core/controller/forms/lbValidator.php";

// 10 octubre 2014
include "controller/Model.php";
include "admin/core/controller/Bootload.php";
include "admin/core/controller/Action.php";

// 13 octubre 2014
include "admin/core/controller/Request.php";


// 14 octubre 2014
include "admin/core/controller/Get.php";
include "admin/core/controller/Post.php";
include "admin/core/controller/Cookie.php";
include "admin/core/controller/Session.php";
include "admin/core/controller/Lb.php";

// 26 diciembre 2014
include "admin/core/controller/Form.php";

include "admin/core/controller/IpLogger.php";
include "admin/core/controller/Viewer.php";
include "admin/core/controller/class.upload.php";

?>