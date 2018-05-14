Camera = function(game, canvas) {
    // La scène du jeu
    this.scene = game.scene;

    // Initialisation de la caméra
    this._initCamera(this.scene, canvas);

};

Camera.prototype = {
    _initCamera : function(scene, canvas) {
        // On crée la caméra
        this.camera = new BABYLON.ArcRotateCamera("Camera", -Math.PI/2, Math.PI / 3, 25, new BABYLON.Vector3(0, 0, 4.5), scene);

        // On demande à la caméra de regarder au point zéro de la scène
        this.camera.setTarget(BABYLON.Vector3.Zero());
        //Limite l'axe vertical de la camera
        this.camera.lowerBetaLimit = 0.1;
        this.camera.upperBetaLimit = (Math.PI / 2);
        //Limite le zoom de la camera
        this.camera.lowerRadiusLimit = 1;
        this.camera.upperRadiusLimit = 150;
        // On affecte le mouvement de la caméra au canvas
        this.camera.attachControl(canvas, true);
    }
};
