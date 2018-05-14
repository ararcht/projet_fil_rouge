// Page entièrement chargé, on lance le jeu
document.addEventListener("DOMContentLoaded", function () {
    new Init('renderCanvas');
}, false);

Init = function(canvasId) {
    // Canvas et engine défini ici
    var canvas = document.getElementById(canvasId);
    var engine = new BABYLON.Engine(canvas, true);
    var _this = this;

	// On initie la scène avec une fonction associé à l'objet Init

	this.scene = this._initScene(engine);

	// On apelle Camera
	var _camera = new Camera(_this, canvas);

	// On apelle House_1
	var _house_1 = new House_1(_this);

	//Début chargement
	engine.displayLoadingUI();
	// Permet au jeu de tourner
	engine.runRenderLoop(function () {
		_this.scene.render();
		//Fin Chargement
		engine.hideLoadingUI();
	});

    // Ajuste la vue 3D si la fenetre est agrandi ou diminué
    window.addEventListener("resize", function () {
        if (engine) {
            engine.resize();
        }
    },false);
    document.getElementById("canvasUp").addEventListener("click",function () {
      engine.resize();
    })
    document.getElementById("canvasDown").addEventListener("click",function () {
      engine.resize();
    })
};

Init.prototype = {
    // Prototype d'initialisation de la scène
    _initScene : function(engine) {
        var scene = new BABYLON.Scene(engine);
        scene.clearColor=new BABYLON.Color3(0.9,0.9,0.9);
        return scene;
    }
};

//Si WebGL non supporté por le navigateur affichage d'une erreur
if (!BABYLON.Engine.isSupported()) {
    document.getElementById("notSupported").className = "";
} else {
    //loadCustomScene(demo.constructor, demo.onload);
};
