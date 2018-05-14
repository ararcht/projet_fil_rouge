House_1 = function(init) {
  // Appel des variables nécéssaires
  this.init = init;
  var scene = init.scene;

  //Def lumière et ombre
  var light = new BABYLON.DirectionalLight("dir01", new BABYLON.Vector3(0, -50, 20), scene);
    light.specular = new BABYLON.Color3(0.1, 0.1, 0.1);
  var light2 = new BABYLON.DirectionalLight("dir02", new BABYLON.Vector3(50, 1, 0), scene);
    light2.specular = new BABYLON.Color3(0.1, 0.1, 0.1);
  var light3 = new BABYLON.DirectionalLight("dir03", new BABYLON.Vector3(-50, 1, 0), scene);
    light3.specular = new BABYLON.Color3(0.1, 0.1, 0.1);
  var light4 = new BABYLON.DirectionalLight("dir04", new BABYLON.Vector3(0, 1, -50), scene);
    light4.specular = new BABYLON.Color3(0.1, 0.1, 0.1);
  var shadowGenerator = new BABYLON.ShadowGenerator(1024, light);
  shadowGenerator.setDarkness(0.2);
/*
  var light2 = new BABYLON.HemisphericLight("light1", new BABYLON.Vector3(0, 20, 0), scene);
    light2.specular = new BABYLON.Color3(0.1, 0.1, 0.1)
*/
  //Materiel et texture mur ext
  var murExt = new BABYLON.StandardMaterial("murExt", scene);
    murExt.diffuseTexture = new BABYLON.Texture("assets/images/wood_texture_1.jpg", scene);

  //Materiel et texture mur int
  var murInt = new BABYLON.StandardMaterial("murInt", scene);
    murInt.diffuseColor = new BABYLON.Color3(240/255, 223/255, 203/255);

  //Materiel et texture toit
  var toit = new BABYLON.StandardMaterial("toit", scene);
  toit.diffuseTexture = new BABYLON.Texture("assets/images/tile_texture_1.jpg", scene);

  //Materiel et texture sol
  var sol = new BABYLON.StandardMaterial("sol", scene);
    sol.diffuseTexture = new BABYLON.Texture("assets/images/wood_texture_2.jpg", scene);

  //Materiel et texture solMonde
  var solMonde = new BABYLON.StandardMaterial('solMonde', scene);
    solMonde.diffuseTexture = new BABYLON.Texture("assets/images/grass_texture_1.jpg", scene);
    solMonde.diffuseTexture.uScale = 500.0;
    solMonde.diffuseTexture.vScale = 500.0;

  //Création sol Monde
  var monde = BABYLON.Mesh.CreateGround("box1", 1000, 1000 ,BABYLON.Mesh.BACKSIDE, scene);
    monde.material = solMonde;
    monde.position.y = -3.01;
    //Autorise l'affichage d'ombre sur la structure
    monde.receiveShadows = true;

  // Sky material
	var skyboxMaterial = new BABYLON.SkyMaterial("skyMaterial", scene);
    skyboxMaterial.backFaceCulling = false;

	// Creation skybox
  var skybox = BABYLON.Mesh.CreateBox("skyBox", 1000.0, scene);
    skybox.material = skyboxMaterial;

	/*
	* Keys:
	* - 1: Day
	* - 2: Evening
	* - 3: Increase Luminance
	* - 4: Decrease Luminance
	* - 5: Increase Turbidity
	* - 6: Decrease Turbidity
	*/

  //Modificateur param skybox
  var setSkyConfig = function (property, from, to) {
    var keys = [
            { frame: 0, value: from },
      { frame: 100, value: to }
        ];

    var animation = new BABYLON.Animation("animation", property, 100, BABYLON.Animation.ANIMATIONTYPE_FLOAT, BABYLON.Animation.ANIMATIONLOOPMODE_CONSTANT);
    animation.setKeys(keys);

    scene.stopAnimation(skybox);
    scene.beginDirectAnimation(skybox, [animation], 0, 100, false, 1);
  };
  //Modificateur param lumière
	var setLightConfig = function (from, to) {
		var keys = [
      { frame: 0, value: from },
      { frame: 100, value: to }
    ];

		var animation = new BABYLON.Animation("animation", "specular", 100, BABYLON.Animation.ANIMATIONTYPE_COLOR3, BABYLON.Animation.ANIMATIONLOOPMODE_CONSTANT);
		animation.setKeys(keys);

    scene.stopAnimation(light);

    scene.beginDirectAnimation(light, [animation], 0, 100, false, 1);
	};
  //Modificateur param skybox
  var setSkyConfig = function (property, from, to) {
    var keys = [
      { frame: 0, value: from },
      { frame: 100, value: to }
    ];

    var animation = new BABYLON.Animation("animation", property, 100, BABYLON.Animation.ANIMATIONTYPE_FLOAT, BABYLON.Animation.ANIMATIONLOOPMODE_CONSTANT);
    animation.setKeys(keys);

    scene.stopAnimation(skybox);
    scene.beginDirectAnimation(skybox, [animation], 0, 100, false, 1);
  };
  //Modificateur lumière et ciel
  var setSkyLightConfig = function (fIncli, ToIncli, FL1, ToL1, FL2, ToL2, FL3, ToL3, FL4, ToL4) {
    var keys = [
      { frame: 0, value: fIncli },
      { frame: 100, value: ToIncli }
    ];
    var keys2 = [
      { frame: 0, value: FL1},
      { frame: 100, value: ToL1 }
    ];
	var keys3 = [
      { frame: 0, value: FL2 },
      { frame: 100, value: ToL2 }
    ];
    var keys4 = [
      { frame: 0, value: FL3},
      { frame: 100, value: ToL3 }
    ];
    var keys5 = [
      { frame: 0, value: FL4},
      { frame: 100, value: ToL4 }
    ];

    var animation = new BABYLON.Animation("animation", "material.inclination", 100, BABYLON.Animation.ANIMATIONTYPE_FLOAT, BABYLON.Animation.ANIMATIONLOOPMODE_CONSTANT);
    animation.setKeys(keys);

    var animation2 = new BABYLON.Animation("animation2", "direction", 100, BABYLON.Animation.ANIMATIONTYPE_VECTOR3, BABYLON.Animation.ANIMATIONLOOPMODE_CONSTANT);
    animation2.setKeys(keys2);

	var animation3 = new BABYLON.Animation("animation3", "direction", 100, BABYLON.Animation.ANIMATIONTYPE_VECTOR3, BABYLON.Animation.ANIMATIONLOOPMODE_CONSTANT);
    animation3.setKeys(keys3);

    var animation4 = new BABYLON.Animation("animation4", "direction", 100, BABYLON.Animation.ANIMATIONTYPE_VECTOR3, BABYLON.Animation.ANIMATIONLOOPMODE_CONSTANT);
    animation4.setKeys(keys4);

	var animation5 = new BABYLON.Animation("animation5", "direction", 100, BABYLON.Animation.ANIMATIONTYPE_VECTOR3, BABYLON.Animation.ANIMATIONLOOPMODE_CONSTANT);
    animation5.setKeys(keys5);

    scene.stopAnimation(skybox);
    scene.stopAnimation(light);
  	scene.stopAnimation(light2);
  	scene.stopAnimation(light3);
  	scene.stopAnimation(light4);

    scene.beginDirectAnimation(skybox, [animation], 0, 100, false, 1);
    scene.beginDirectAnimation(light, [animation2], 0, 100, false, 1);
  	scene.beginDirectAnimation(light2, [animation3], 0, 100, false, 1);
  	scene.beginDirectAnimation(light3, [animation4], 0, 100, false, 1);
  	scene.beginDirectAnimation(light4, [animation5], 0, 100, false, 1);
  };

	window.addEventListener("keydown", function (evt) {
		switch (evt.keyCode) {
			case 50: setSkyLightConfig(skyboxMaterial.inclination, 2.2, light.direction, new BABYLON.Vector3(0, -25, 10), light2.direction, new BABYLON.Vector3(1000, 0, 0), light3.direction, new BABYLON.Vector3(-1000, 0, 0), light4.direction, new BABYLON.Vector3(0, 0, -1000)); break; // 1
			case 51: setSkyLightConfig(skyboxMaterial.inclination, 2.5, light.direction, new BABYLON.Vector3(0, -10, 20), light2.direction, new BABYLON.Vector3(1000, 5000, 0), light3.direction, new BABYLON.Vector3(-1000, 5000, 0), light4.direction, new BABYLON.Vector3(0, 5000, -1000)); break; // 2
			case 49: setSkyLightConfig(skyboxMaterial.inclination, 1.53, light.direction, new BABYLON.Vector3(0, -17, -17), light2.direction, new BABYLON.Vector3(1000, 5000, 0), light3.direction, new BABYLON.Vector3(-1000, 5000, 0), light4.direction, new BABYLON.Vector3(0, 5000, 1000)); break; // 2

			case 52: setSkyConfig("material.luminance", skyboxMaterial.luminance, 0.1); break; // 3
			case 53: setSkyConfig("material.luminance", skyboxMaterial.luminance, 1.0); break; // 4

			case 54: setSkyConfig("material.turbidity", skyboxMaterial.turbidity, 40); break; // 5
			case 55: setSkyConfig("material.turbidity", skyboxMaterial.turbidity, 5); break; // 6

			default: break;
		}
  });

	// init jour
	setSkyLightConfig(skyboxMaterial.inclination, 2.2, light.direction, new BABYLON.Vector3(0, -50, 20), light2.direction, new BABYLON.Vector3(1000, 0, 0), light3.direction, new BABYLON.Vector3(-1000, 0, 0), light4.direction, new BABYLON.Vector3(0, 0, -1000));

  //Charge arbre
  var assetsManager = new BABYLON.AssetsManager(scene);
  var meshTask = assetsManager.addMeshTask("skull task", "", "assets/tree/", "Tree.obj");
  meshTask.onSuccess = function (task) {
    task.loadedMeshes[0].position = new BABYLON.Vector3(10,-3.01,0);
    shadowGenerator.getShadowMap().renderList.push(task.loadedMeshes[0]);
    task.loadedMeshes[1].position = new BABYLON.Vector3(10,-3.01,0);
    shadowGenerator.getShadowMap().renderList.push(task.loadedMeshes[1]);
  }
	assetsManager.onFinish = function (tasks) {
		engine.runRenderLoop(function () {
			scene.render();
		});
	};
	assetsManager.load();

  /*
  ////////////
  Création de la maison
  ///////////
  */

  //Def mur ext avant
  var murAvDef = [
    new BABYLON.Vector3(-5.5, 0, -3),

    //Contour porte
    new BABYLON.Vector3(-0.5, 0, -3),
    new BABYLON.Vector3(-0.5, 0, -0.75),
    new BABYLON.Vector3(0.5, 0, -0.75),
    new BABYLON.Vector3(0.5, 0, -3),

    new BABYLON.Vector3(5.5, 0, -3),

    new BABYLON.Vector3(5.5, 0, 0),

    new BABYLON.Vector3(-5.5, 0, 0)
  ];

  //Def emplacement fenêtre
  var fenAvDef = [];
  //Gauche
  fenAvDef[0] = [
    new BABYLON.Vector3(-4.78, 0, -2.3),
    new BABYLON.Vector3(-1.58, 0, -2.3),
    new BABYLON.Vector3(-1.58, 0, -0.3),
    new BABYLON.Vector3(-4.78, 0, -0.3)
  ];
  //Droite
	fenAvDef[1] = [
    new BABYLON.Vector3(1.58, 0, -2.3),
		new BABYLON.Vector3(4.78, 0, -2.3),
		new BABYLON.Vector3(4.78, 0, -0.3),
    new BABYLON.Vector3(1.58, 0, -0.3)
  ];

  //Création de l'obj mur
  var murAv = BABYLON.MeshBuilder.ExtrudePolygon("murAv", {shape:murAvDef, depth: 0.15, holes:fenAvDef}, scene);
  //rotation pour passer l'obj d'horizontale à vertical
  murAv.rotation.x = -Math.PI/2;
  //Ajout texture mur
  murAv.material = murExt;
  //Généraion ombre pour la structure
  shadowGenerator.getShadowMap().renderList.push(murAv);
  murAv.receiveShadows = true;


  //Déf mur arrière
  var murArDef = [
    new BABYLON.Vector3(-5.5, 0, -3),
    new BABYLON.Vector3(5.5, 0, -3),
    new BABYLON.Vector3(5.5, 0, 0),
    new BABYLON.Vector3(-5.5, 0, 0)
  ];

  //Def emplacement fenêtre
  var fenArDef = [];
	fenArDef[0] = [
    new BABYLON.Vector3(3.7, 0, -1.8),
    new BABYLON.Vector3(4.5, 0, -1.8),
    new BABYLON.Vector3(4.5, 0, -0.3),
    new BABYLON.Vector3(3.7, 0, -0.3)
  ];

  //Création de l'obj mur
  var murAr = BABYLON.MeshBuilder.ExtrudePolygon("murAr", {shape:murArDef, depth: 0.1, holes: fenArDef}, scene);
  //rotation pour passer l'obj d'horizontale à vertical
  murAr.rotation.x = -Math.PI/2;
  //Placement du mur par rapport au mur avant
  murAr.position.z = 10.40;
  //Ajout texture mur
  murAr.material = murExt;
  //Généraion ombre pour la structure
  shadowGenerator.getShadowMap().renderList.push(murAr);
  murAr.receiveShadows = true;


  //Déf mur droite
  var murDroitDef = [
    new BABYLON.Vector3(-5.50, 0, -3),
    new BABYLON.Vector3(5, 0, -3),
    new BABYLON.Vector3(5, 0, 0),
    //Angle toit
    new BABYLON.Vector3(0, 0, 3.5),

    new BABYLON.Vector3(-5.50, 0, 0)
  ];

  //Création de l'obj mur
  var murDroit = BABYLON.MeshBuilder.ExtrudePolygon("murDroit", {shape:murDroitDef, depth: 0.1}, scene);
  //rotation pour passer l'obj d'horizontale à vertical et le tourné à 90°
  murDroit.rotation.z = -Math.PI/2;
  murDroit.rotation.x = -Math.PI/2;
  //Placement du mur par rapport au mur avant
  murDroit.position.x = 5.6;
  murDroit.position.z = 5.50;
  //Ajout texture mur
  murDroit.material = murExt;
  //Généraion ombre pour la structure
  shadowGenerator.getShadowMap().renderList.push(murDroit);
  murDroit.receiveShadows = true;


  //Déf mur Gauche
  var murGaucheDef = [
    new BABYLON.Vector3(-5.50, 0, -3),
    new BABYLON.Vector3(5, 0, -3),
    new BABYLON.Vector3(5, 0, 0),
    //Angle toit
    new BABYLON.Vector3(0, 0, 3.5),

    new BABYLON.Vector3(-5.50, 0, 0)
  ];

  //Def emplacement fenêtre
  var fenGaucheDef = [];
  fenGaucheDef[0] = [
    new BABYLON.Vector3(2.7, 0, -1.8),
    new BABYLON.Vector3(3.5, 0, -1.8),
    new BABYLON.Vector3(3.5, 0, -0.3),
    new BABYLON.Vector3(2.7, 0, -0.3)
  ];

  //Création de l'obj mur
  var murGauche = BABYLON.MeshBuilder.ExtrudePolygon("murGauche", {shape:murGaucheDef, depth: 0.1, holes: fenGaucheDef}, scene);
  //rotation pour passer l'obj d'horizontale à vertical et le tourné à 90°
  murGauche.rotation.z = -Math.PI/2;
  murGauche.rotation.x = -Math.PI/2;
  //Placement du mur par rapport au mur avant
  murGauche.position.x = -5.5;
  murGauche.position.z = 5.50;
  //Ajout texture mur
  murGauche.material = murExt;
  //Généraion ombre pour la structure
  shadowGenerator.getShadowMap().renderList.push(murGauche);
  murGauche.receiveShadows = true;


  //Déf toit
  var toitDef = [
    new BABYLON.Vector3(-0.05, 0, -3.90),
  	new BABYLON.Vector3(0.1, 0, -3.90),
  	new BABYLON.Vector3(5.65, 0, -0.35),
  	new BABYLON.Vector3(10.8, 0, -3.95),
  	new BABYLON.Vector3(10.9, 0, -3.95),
  	new BABYLON.Vector3(5.65, 0, -0.2)
  ];

  //Création de l'obj toit1
  var toit1 = BABYLON.MeshBuilder.ExtrudePolygon("toit1", {shape:toitDef, depth: 11.5}, scene);
  //rotation pour passer l'obj d'horizontale à vertical et le tourné à 90°
  toit1.rotation.z = -Math.PI/2;
  toit1.rotation.x = -Math.PI/2;
  //Placement du toit par rapport au mur avant
  toit1.position.x = 5.7;
  toit1.position.y = 3.85;
  toit1.position.z = -0.15;
  //Ajout texture toit
  toit1.material = toit;
  //Généraion ombre pour la structure
  shadowGenerator.getShadowMap().renderList.push(toit1);

  //Association de tout les toits en un objet
  var toitComplet = BABYLON.Mesh.MergeMeshes([toit1], true);


  //Def Sol
  var solDef = [
  	new BABYLON.Vector3(-5.6, 0, -0.1),
    new BABYLON.Vector3(5.6, 0, -0.1),
    new BABYLON.Vector3(5.6, 0, 10.35),
    new BABYLON.Vector3(-5.6, 0, 10.35)
  ];

  //Création de l'obj sol1
  var sol1 = BABYLON.MeshBuilder.ExtrudePolygon("sol1", {shape:solDef, depth: 0.04}, scene);
  //Placement du sol par rapport au mur avant
  sol1.position.y = -3;
  sol1.position.z = 0.15;
  //Ajout texture sol
  sol1.material = sol;
  //Autorise l'affichage d'ombre sur la structure
  sol1.receiveShadows = true;


  //Def plafond
  var plafondDef = [
    new BABYLON.Vector3(-5.5, 0, 0),
    new BABYLON.Vector3(5.5, 0, 0),
    new BABYLON.Vector3(5.5, 0, 10.25),
    new BABYLON.Vector3(-5.5, 0, 10.25)
  ];

  //Création de l'obj plafond1
  var plafond1 = BABYLON.MeshBuilder.ExtrudePolygon("plafond1", {shape:plafondDef, depth: 0.1}, scene);
  //Placement du plafond par rapport au mur avant
  plafond1.position.y = 0;
  plafond1.position.z = 0.15;
  //Ajout texture plafond
  plafond1.material = murInt;
  //Généraion ombre pour la structure
  shadowGenerator.getShadowMap().renderList.push(plafond1);

  //Def murInt 1
  var murInt1Def = [
    new BABYLON.Vector3(-3, 0, 0),
    new BABYLON.Vector3(0, 0, 0),
    new BABYLON.Vector3(0, 0, 5),
    new BABYLON.Vector3(-3, 0, 5),
  ];

  //Création de l'obj murInt1
  var murInt1 = BABYLON.MeshBuilder.ExtrudePolygon("murInt1", {shape:murInt1Def, depth: 0.1}, scene);
  //rotation pour passer l'obj d'horizontale à vertical
  murInt1.rotation.z = Math.PI/2;
  //Placement du mur1 par rapport au mur avant
  murInt1.position.x = 1.35;
  murInt1.position.z = 5.40;
  murInt1.position.x = -1.4;
  //Ajout texture mur
  murInt1.material = murInt;
  //Généraion ombre pour la structure
  shadowGenerator.getShadowMap().renderList.push(murInt1);
  //Autorise l'affichage d'ombre sur la structure
  murInt1.receiveShadows = true;

  //Def murInt 2
  var murInt2Def = [
    new BABYLON.Vector3(-1.4, 0, 0),

    //Passage
    new BABYLON.Vector3(-0.5, 0, 0),
    new BABYLON.Vector3(-0.5, 0, 2),
    new BABYLON.Vector3(0.5, 0, 2),
    new BABYLON.Vector3(0.5, 0, 0),

    new BABYLON.Vector3(5.5, 0, 0),
    new BABYLON.Vector3(5.5, 0, 3),
    new BABYLON.Vector3(-1.4, 0, 3)
  ];

  //Création de l'obj murInt2
  var murInt2 = BABYLON.MeshBuilder.ExtrudePolygon("murInt2", {shape:murInt2Def, depth: 0.1}, scene);
  //rotation pour passer l'obj d'horizontale à vertical
  murInt2.rotation.x = -Math.PI/2;
  //Placement du mur1 par rapport au mur avant
  murInt2.position.x = 0;
  murInt2.position.y = -3;
  murInt2.position.z = 7;
  //Ajout texture mur
  murInt2.material = murInt;
  //Généraion ombre pour la structure
  shadowGenerator.getShadowMap().renderList.push(murInt2);
  //Autorise l'affichage d'ombre sur la structure
  murInt2.receiveShadows = true;


  //Def murInt 3
  var murInt3Def = [
    new BABYLON.Vector3(-3, 0, 0),
    new BABYLON.Vector3(0, 0, 0),
    new BABYLON.Vector3(0, 0, 4.2),
    new BABYLON.Vector3(-3, 0, 4.2),

    //Passage
    new BABYLON.Vector3(-3, 0, 1.6),
    new BABYLON.Vector3(-1, 0, 1.6),
    new BABYLON.Vector3(-1, 0, 0.6),
    new BABYLON.Vector3(-3, 0, 0.6)
  ];

  //Création de l'obj murInt1
  var murInt3 = BABYLON.MeshBuilder.ExtrudePolygon("murInt3", {shape:murInt3Def, depth: 0.1}, scene);
  //rotation pour passer l'obj d'horizontale à vertical
  murInt3.rotation.z = Math.PI/2;
  murInt3.rotation.y = Math.PI/2;
  //Placement du mur1 par rapport au mur avant
  murInt3.position.z = 5.5;
  murInt3.position.x = -5.5;
  //Ajout texture mur
  murInt3.material = murInt;
  //Généraion ombre pour la structure
  shadowGenerator.getShadowMap().renderList.push(murInt3);
  //Autorise l'affichage d'ombre sur la structure
  murInt3.receiveShadows = true;


  //Def murInt 4
  var murInt4Def = [
    new BABYLON.Vector3(-1, 0, 0),
    new BABYLON.Vector3(0, 0, 0),
    new BABYLON.Vector3(0, 0, 4.1),
    new BABYLON.Vector3(-1, 0, 4.1),
  ];

  //Création de l'obj murInt1
  var murInt4 = BABYLON.MeshBuilder.ExtrudePolygon("murInt4", {shape:murInt4Def, depth: 0.1}, scene);
  //rotation pour passer l'obj d'horizontale à vertical
  murInt4.rotation.z = Math.PI/2;
  //Placement du mur1 par rapport au mur avant
  murInt4.position.z = 0.1;
  murInt4.position.x = 1;
  murInt4.position.y = -2;
  //Ajout texture mur
  murInt4.material = murInt;
  //Généraion ombre pour la structure
  shadowGenerator.getShadowMap().renderList.push(murInt4);
  //Autorise l'affichage d'ombre sur la structure
  murInt4.receiveShadows = true;


  //Def murInt 5
  var murInt5Def = [
    new BABYLON.Vector3(-1, 0, 0),
    new BABYLON.Vector3(0, 0, 0),
    new BABYLON.Vector3(0, 0, 3.5),
    new BABYLON.Vector3(-1, 0, 3.5),
  ];

  //Création de l'obj murInt1
  var murInt5 = BABYLON.MeshBuilder.ExtrudePolygon("murInt5", {shape:murInt5Def, depth: 0.1}, scene);
  //rotation pour passer l'obj d'horizontale à vertical
  murInt5.rotation.z = Math.PI/2;
  murInt5.rotation.y = Math.PI/2;
  //Placement du mur1 par rapport au mur avant
  murInt5.position.y = -2;
  murInt5.position.z = 4.2;
  murInt5.position.x = 2;
  //Ajout texture mur
  murInt5.material = murInt;
  //Généraion ombre pour la structure
  shadowGenerator.getShadowMap().renderList.push(murInt3);
  //Autorise l'affichage d'ombre sur la structure
  murInt5.receiveShadows = true;


  //Function pour crée fenêtre
  var windowMaker = function(width, height, frames, frameDepth, frameThickness) {
  	var windowShape = [
  		new BABYLON.Vector3(0, 0, 0),
  		new BABYLON.Vector3(width, 0, 0),
  		new BABYLON.Vector3(width, 0, height),
  		new BABYLON.Vector3(0, 0, height)
  	];
  	var glassWidth = (width - (frames + 1) * frameThickness)/frames;
  	var glassTopHeight = height/3 - frameThickness;
  	var glassBotHeight = 2 * glassTopHeight;
  	var glass = [];
  	var acf = frameThickness;
  	for(var f = 0; f < frames; f++) {
  		glass[2*f] = [];
  		glass[2*f].push(new BABYLON.Vector3(acf, 0, 2*frameThickness + glassBotHeight));
  		glass[2*f].push(new BABYLON.Vector3(acf + glassWidth, 0, 2 * frameThickness + glassBotHeight));
  		glass[2*f].push(new BABYLON.Vector3(acf + glassWidth, 0, 2 * frameThickness + glassBotHeight + glassTopHeight));
  		glass[2*f].push(new BABYLON.Vector3(acf, 0, 2 * frameThickness + glassBotHeight + glassTopHeight));
  		glass[2*f + 1] = [];
  		glass[2*f + 1].push(new BABYLON.Vector3(acf, 0, frameThickness));
  		glass[2*f + 1].push(new BABYLON.Vector3(acf + glassWidth, 0, frameThickness));
  		glass[2*f + 1].push(new BABYLON.Vector3(acf + glassWidth, 0, frameThickness + glassBotHeight));
  		glass[2*f + 1].push(new BABYLON.Vector3(acf, 0, frameThickness + glassBotHeight));
  		acf += frameThickness + glassWidth;
  	}
  	var window = BABYLON.MeshBuilder.ExtrudePolygon("window", {shape:windowShape, holes: glass, depth: frameDepth}, scene);
  	window.rotation.x = -Math.PI/2;
  	return window;
  }

  //fenMurAvGauche
  var fenMurAvGauche = windowMaker(3.2, 2, 4, 0.15, 0.1);
  fenMurAvGauche.position.x = -4.78;
  fenMurAvGauche.position.y = -2.3;
  fenMurAvGauche.position.z = 0.1;
  shadowGenerator.getShadowMap().renderList.push(fenMurAvGauche);

  //fenMurAvDroite
  var fenMurAvDroite = windowMaker(3.2, 2, 4, 0.15, 0.1);
  fenMurAvDroite.position.x = 1.58;
  fenMurAvDroite.position.y = -2.3;
  fenMurAvDroite.position.z = 0.1;
  shadowGenerator.getShadowMap().renderList.push(fenMurAvDroite);

  //fenMurArGauche
  var fenMurArGauche = windowMaker(0.8, 1.5, 1, 0.15, 0.1);
  fenMurArGauche.position.x = 3.7;
  fenMurArGauche.position.y = -1.8;
  fenMurArGauche.position.z = 10.3;
  shadowGenerator.getShadowMap().renderList.push(fenMurArGauche);

  //fenMurGauche
  var fenMurGauche = windowMaker(0.8, 1.5, 1, 0.15, 0.1);
  fenMurGauche.position.x = -5.6;
  fenMurGauche.position.y = -1.8;
  fenMurGauche.position.z = 9;
  fenMurGauche.rotation.y = Math.PI/2
  shadowGenerator.getShadowMap().renderList.push(fenMurGauche);

  //Function pour crée porte
  var doorMaker = function(width, height, depth) {
  	var doorShape = [
  		new BABYLON.Vector3(0, 0, 0),
  		new BABYLON.Vector3(width, 0, 0),
  		new BABYLON.Vector3(width, 0, height),
  		new BABYLON.Vector3(0, 0, height)
  	];
  	edgeThickness = width/8
  	var panelWidth = width - 2 * edgeThickness;
  	var panelBotHeight = (height - 3 * edgeThickness)/1.75;
  	var panelTopHeight = 0.75 * panelBotHeight;
  	var panel = [];
  	panel[0] = [];
  	panel[0].push(new BABYLON.Vector3(edgeThickness, 0, 2*edgeThickness + panelBotHeight));
  	panel[0].push(new BABYLON.Vector3(edgeThickness + panelWidth, 0, 2 * edgeThickness + panelBotHeight));
  	panel[0].push(new BABYLON.Vector3(edgeThickness + panelWidth, 0, 2 * edgeThickness + panelBotHeight + panelTopHeight));
  	panel[0].push(new BABYLON.Vector3(edgeThickness, 0, 2 * edgeThickness + panelBotHeight + panelTopHeight));
  	panel[1] = [];
  	panel[1].push(new BABYLON.Vector3(edgeThickness, 0, edgeThickness));
  	panel[1].push(new BABYLON.Vector3(edgeThickness + panelWidth, 0, edgeThickness));
  	panel[1].push(new BABYLON.Vector3(edgeThickness + panelWidth, 0, edgeThickness + panelBotHeight));
  	panel[1].push(new BABYLON.Vector3(edgeThickness, 0, edgeThickness + panelBotHeight));
  	var door = BABYLON.MeshBuilder.ExtrudePolygon("door", {shape:doorShape, holes: panel, depth: depth}, scene);
  	door.rotation.x = -Math.PI/2;
  	var panelB = BABYLON.MeshBuilder.CreateBox("p1b", {width: panelWidth, height: panelBotHeight, depth: depth/2}, scene);
  	panelB.position.x = edgeThickness + panelWidth/2;
  	panelB.position.y = edgeThickness + panelBotHeight/2;
  	panelB.position.z = depth/2;
  	var panelT = BABYLON.MeshBuilder.CreateBox("p1t", {width: panelWidth, height: panelTopHeight, depth: depth/2}, scene);
  	panelT.position.x = edgeThickness + panelWidth/2;
  	panelT.position.y = 2*edgeThickness + panelBotHeight + panelTopHeight/2;
  	panelT.position.z = depth/2;

  	return BABYLON.Mesh.MergeMeshes([door, panelB, panelT], true);
  };

  //porteMurAv
  var porteMurAv = doorMaker(1, 2.25, 0.1, 0.05);
  porteMurAv.position.x = -0.5;
  porteMurAv.position.y = -3;
  porteMurAv.position.z = 0.1;
  shadowGenerator.getShadowMap().renderList.push(porteMurAv);

  /*
  ////////////
    Option d'afficher/Cacher GUI
  ///////////
  */
  var option = BABYLON.GUI.AdvancedDynamicTexture.CreateFullscreenUI("UI");

  var panel = new BABYLON.GUI.StackPanel();
  panel.width = "210px";
  panel.isVertical = true;
  panel.horizontalAlignment = BABYLON.GUI.Control.HORIZONTAL_ALIGNMENT_LEFT;
  panel.verticalAlignment = BABYLON.GUI.Control.VERTICAL_ALIGNMENT_TOP;
  option.addControl(panel);

  var panelHeading = new BABYLON.GUI.StackPanel();
  panelHeading.width = "150px";
  panelHeading.height = "45px";
  panelHeading.isVertical = false;
  panelHeading.horizontalAlignment = BABYLON.GUI.Control.HORIZONTAL_ALIGNMENT_LEFT;
  panelHeading.verticalAlignment = BABYLON.GUI.Control.VERTICAL_ALIGNMENT_CENTER;
  panel.addControl(panelHeading);

  var heading = new BABYLON.GUI.TextBlock();
  heading.text = "Afficher/Cacher";
  heading.width = "180px";
  heading.height = "40px"
  heading.paddingLeft = "10px";
  heading.paddingBottom = "15px";
  heading.textHorizontalAlignment = BABYLON.GUI.Control.HORIZONTAL_ALIGNMENT_LEFT;
  heading.color = "white";
  panelHeading.addControl(heading);

  var paneltoitComplet = new BABYLON.GUI.StackPanel();
  paneltoitComplet.width = "150px";
  paneltoitComplet.height = "25px";
  paneltoitComplet.isVertical = false;
  paneltoitComplet.horizontalAlignment = BABYLON.GUI.Control.HORIZONTAL_ALIGNMENT_LEFT;
  paneltoitComplet.verticalAlignment = BABYLON.GUI.Control.VERTICAL_ALIGNMENT_CENTER;
  panel.addControl(paneltoitComplet);


  //Controle Toit
  var checkboxtoitComplet = new BABYLON.GUI.Checkbox();
  checkboxtoitComplet.width = "20px";
  checkboxtoitComplet.height = "20px";
  checkboxtoitComplet.isChecked = true;
  checkboxtoitComplet.color = "green";
  checkboxtoitComplet.onIsCheckedChangedObservable.add(function(value) {
    if (value) {
      checkboxtoitComplet.color = "green";
      toitComplet.isVisible = true;
      plafond1.isVisible = true;
    }
    else {
    	checkboxtoitComplet.color = "red";
    	toitComplet.isVisible = false;
    	plafond1.isVisible = false;
    }
  });
  paneltoitComplet.addControl(checkboxtoitComplet);

  var texttoitComplet = new BABYLON.GUI.TextBlock();
  texttoitComplet.text = "Toit";
  texttoitComplet.width = "180px";
  texttoitComplet.paddingLeft = "10px";
  texttoitComplet.textHorizontalAlignment = BABYLON.GUI.Control.HORIZONTAL_ALIGNMENT_LEFT;
  texttoitComplet.color = "white";
  paneltoitComplet.addControl(texttoitComplet);


  //Controle Mur Av
  var panelMurAv = new BABYLON.GUI.StackPanel();
  panelMurAv.width = "150px";
  panelMurAv.height = "25px";
  panelMurAv.isVertical = false;
  panelMurAv.horizontalAlignment = BABYLON.GUI.Control.HORIZONTAL_ALIGNMENT_LEFT;
  panelMurAv.verticalAlignment = BABYLON.GUI.Control.VERTICAL_ALIGNMENT_CENTER;
  panel.addControl(panelMurAv);

  var checkboxMurAv = new BABYLON.GUI.Checkbox();
  checkboxMurAv.width = "20px";
  checkboxMurAv.height = "20px";
  checkboxMurAv.isChecked = true;
  checkboxMurAv.color = "green";
  checkboxMurAv.onIsCheckedChangedObservable.add(function(value) {
    if (value) {
      checkboxMurAv.color = "green";
  		murAv.isVisible = true;
  		fenMurAvGauche.isVisible = true;
  		fenMurAvDroite.isVisible = true;
  		porteMurAv.isVisible = true;
    }
    else {
		checkboxMurAv.color = "red";
		murAv.isVisible = false;
		fenMurAvGauche.isVisible = false;
		fenMurAvDroite.isVisible = false;
		porteMurAv.isVisible = false;
    }
  });
  panelMurAv.addControl(checkboxMurAv);

  var textFront = new BABYLON.GUI.TextBlock();
  textFront.text = "Mur Avant";
  textFront.width = "180px";
  textFront.paddingLeft = "10px";
  textFront.textHorizontalAlignment = BABYLON.GUI.Control.HORIZONTAL_ALIGNMENT_LEFT;
  textFront.color = "white";
  panelMurAv.addControl(textFront);


  //Controle Mur Ar
  var panelMurAr = new BABYLON.GUI.StackPanel();
  panelMurAr.width = "150px";
  panelMurAr.height = "25px";
  panelMurAr.isVertical = false;
    panelMurAr.horizontalAlignment = BABYLON.GUI.Control.HORIZONTAL_ALIGNMENT_LEFT;
    panelMurAr.verticalAlignment = BABYLON.GUI.Control.VERTICAL_ALIGNMENT_CENTER;
    panel.addControl(panelMurAr);

  var checkboxMurAr = new BABYLON.GUI.Checkbox();
  checkboxMurAr.width = "20px";
  checkboxMurAr.height = "20px";
  checkboxMurAr.isChecked = true;
  checkboxMurAr.color = "green";
  checkboxMurAr.onIsCheckedChangedObservable.add(function(value) {
    if (value) {
      checkboxMurAr.color = "green";
      murAr.isVisible = true;
      fenMurArGauche.isVisible = true;
    }
  	else {
  		checkboxMurAr.color = "red";
  		murAr.isVisible = false;
  		fenMurArGauche.isVisible = false;
  	}
  });
  panelMurAr.addControl(checkboxMurAr);

  var textBack = new BABYLON.GUI.TextBlock();
  textBack.text = "Mur Arrière";
  textBack.width = "180px";
  textBack.paddingLeft = "10px";
  textBack.textHorizontalAlignment = BABYLON.GUI.Control.HORIZONTAL_ALIGNMENT_LEFT;
  textBack.color = "white";
  panelMurAr.addControl(textBack);


  //Controle Mur Droit
  var panelMurDroit = new BABYLON.GUI.StackPanel();
  panelMurDroit.width = "150px";
  panelMurDroit.height = "25px";
  panelMurDroit.isVertical = false;
  panelMurDroit.horizontalAlignment = BABYLON.GUI.Control.HORIZONTAL_ALIGNMENT_LEFT;
  panelMurDroit.verticalAlignment = BABYLON.GUI.Control.VERTICAL_ALIGNMENT_CENTER;
  panel.addControl(panelMurDroit);

  var checkboxMurDroit = new BABYLON.GUI.Checkbox();
  checkboxMurDroit.width = "20px";
  checkboxMurDroit.height = "20px";
  checkboxMurDroit.isChecked = true;
  checkboxMurDroit.color = "green";
  checkboxMurDroit.onIsCheckedChangedObservable.add(function(value) {
    if (value) {
      checkboxMurDroit.color = "green";
		  murDroit.isVisible = true;
    }
  	else {
  		checkboxMurDroit.color = "red";
  		murDroit.isVisible = false;
  	}
  });
  panelMurDroit.addControl(checkboxMurDroit);

  var textSideLeft = new BABYLON.GUI.TextBlock();
  textSideLeft.text = "Mur droit";
  textSideLeft.width = "180px";
  textSideLeft.paddingLeft = "10px";
  textSideLeft.textHorizontalAlignment = BABYLON.GUI.Control.HORIZONTAL_ALIGNMENT_LEFT;
  textSideLeft.color = "white";
  panelMurDroit.addControl(textSideLeft);


  //Controle Mur Gauche
  var panelMurGauche = new BABYLON.GUI.StackPanel();
  panelMurGauche.width = "150px";
  panelMurGauche.height = "25px";
  panelMurGauche.isVertical = false;
  panelMurGauche.horizontalAlignment = BABYLON.GUI.Control.HORIZONTAL_ALIGNMENT_LEFT;
  panelMurGauche.verticalAlignment = BABYLON.GUI.Control.VERTICAL_ALIGNMENT_CENTER;
  panel.addControl(panelMurGauche);

  var checkboxMurGauche = new BABYLON.GUI.Checkbox();
  checkboxMurGauche.width = "20px";
  checkboxMurGauche.height = "20px";
  checkboxMurGauche.isChecked = true;
  checkboxMurGauche.color = "green";
  checkboxMurGauche.onIsCheckedChangedObservable.add(function(value) {
    if (value) {
      checkboxMurGauche.color = "green";
      murGauche.isVisible = true;
	  fenMurGauche.isVisible = true;
    }
  	else {
  		checkboxMurGauche.color = "red";
  		murGauche.isVisible = false;
		fenMurGauche.isVisible = false;
  	}
  });
  panelMurGauche.addControl(checkboxMurGauche);

  var textSideRight = new BABYLON.GUI.TextBlock();
  textSideRight.text = "Mur gauche";
  textSideRight.width = "180px";
  textSideRight.paddingLeft = "10px";
  textSideRight.textHorizontalAlignment = BABYLON.GUI.Control.HORIZONTAL_ALIGNMENT_LEFT;
  textSideRight.color = "white";
  panelMurGauche.addControl(textSideRight);


  //Desactivation ombre
  var panelOmbre = new BABYLON.GUI.StackPanel();
  panelOmbre.width = "150px";
  panelOmbre.height = "25px";
  panelOmbre.isVertical = false;
  panelOmbre.horizontalAlignment = BABYLON.GUI.Control.HORIZONTAL_ALIGNMENT_LEFT;
  panelOmbre.verticalAlignment = BABYLON.GUI.Control.VERTICAL_ALIGNMENT_CENTER;
  panel.addControl(panelOmbre);

  var checkOmbre = new BABYLON.GUI.Checkbox();
  checkOmbre.width = "20px";
  checkOmbre.height = "20px";
  checkOmbre.isChecked = true;
  checkOmbre.color = "green";
  checkOmbre.onIsCheckedChangedObservable.add(function(value) {
    if (value) {
      checkOmbre.color = "green";
      scene.shadowsEnabled = true;
    }
  	else {
  		checkOmbre.color = "red";
  		scene.shadowsEnabled = false;
  	}
  });
  panelOmbre.addControl(checkOmbre);

  var textOmbre = new BABYLON.GUI.TextBlock();
  textOmbre.text = "Ombre";
  textOmbre.width = "180px";
  textOmbre.paddingLeft = "10px";
  textOmbre.textHorizontalAlignment = BABYLON.GUI.Control.HORIZONTAL_ALIGNMENT_LEFT;
  textOmbre.color = "white";
  panelOmbre.addControl(textOmbre);

  //Fin return graphic
  return scene;
}
