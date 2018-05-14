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
    murExt.diffuseTexture = new BABYLON.Texture($('#texture').attr('murExt'), scene);

  //Materiel et texture mur int
  var murInt = new BABYLON.StandardMaterial("murInt", scene);
    murInt.diffuseColor = new BABYLON.Color3(240/255, 223/255, 203/255);

  //Materiel et texture toit
  var toit = new BABYLON.StandardMaterial("toit", scene);
  toit.diffuseTexture = new BABYLON.Texture($('#texture').attr('toit'), scene);

  //Materiel et texture sol
  var sol = new BABYLON.StandardMaterial("sol", scene);
    sol.diffuseTexture = new BABYLON.Texture($('#texture').attr('solInt'), scene);

  //Materiel et texture solMonde
  var solMonde = new BABYLON.StandardMaterial('solMonde', scene);
    solMonde.diffuseTexture = new BABYLON.Texture($('#texture').attr('solMonde'), scene);
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


			case 51: setSkyConfig("material.luminance", skyboxMaterial.luminance, 0.1); break; // 3
			case 52: setSkyConfig("material.luminance", skyboxMaterial.luminance, 1.0); break; // 4

			case 53: setSkyConfig("material.turbidity", skyboxMaterial.turbidity, 40); break; // 5
			case 54: setSkyConfig("material.turbidity", skyboxMaterial.turbidity, 5); break; // 6

			default: break;
		}
  });

	// init jour
	setSkyLightConfig(skyboxMaterial.inclination, 2.2, light.direction, new BABYLON.Vector3(0, -50, 20), light2.direction, new BABYLON.Vector3(1000, 0, 0), light3.direction, new BABYLON.Vector3(-1000, 0, 0), light4.direction, new BABYLON.Vector3(0, 0, -1000));

  //Charge arbre
  var assetsManager = new BABYLON.AssetsManager(scene);
  var meshTask = assetsManager.addMeshTask("skull task", "", "3d_house/assets/tree/", "Tree.obj");
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
    new BABYLON.Vector3(-5.58, 0, -3),

    //Porte
    new BABYLON.Vector3(-0.5, 0, -3),
    new BABYLON.Vector3(-0.5, 0, -0.75),
    new BABYLON.Vector3(0.5, 0, -0.75),
    new BABYLON.Vector3(0.5, 0, -3),

    new BABYLON.Vector3(5.5, 0, -3),
    new BABYLON.Vector3(5.5, 0, 3),
    new BABYLON.Vector3(-5.58, 0, 3)
  ];

  //Def emplacement fenêtre
  var fenAvDef = [];
  fenAvDef[0] = [
    new BABYLON.Vector3(-4.78, 0, -2.3),
    new BABYLON.Vector3(-1.58, 0, -2.3),
    new BABYLON.Vector3(-1.58, 0, -0.3),
    new BABYLON.Vector3(-4.78, 0, -0.3)
  ];
  fenAvDef[1] = [
    new BABYLON.Vector3(1.58, 0, -2.3),
    new BABYLON.Vector3(4.78, 0, -2.3),
    new BABYLON.Vector3(4.78, 0, -0.3),
    new BABYLON.Vector3(1.58, 0, -0.3)
  ];
  fenAvDef[2] = [
    new BABYLON.Vector3(-4.03, 0, 0.75),
    new BABYLON.Vector3(-2.13, 0, 0.75),
    new BABYLON.Vector3(-2.13, 0, 2.55),
    new BABYLON.Vector3(-4.03, 0, 2.55)
  ];
  fenAvDef[3] = [
    new BABYLON.Vector3(-0.65, 0, 0.75),
    new BABYLON.Vector3(0.65, 0, 0.75),
    new BABYLON.Vector3(0.65, 0, 2.55),
    new BABYLON.Vector3(-0.65, 0, 2.55)
  ];
  fenAvDef[4] = [
    new BABYLON.Vector3(2.13, 0, 0.75),
    new BABYLON.Vector3(4.03, 0, 0.75),
    new BABYLON.Vector3(4.03, 0, 2.55),
    new BABYLON.Vector3(2.13, 0, 2.55)
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
    new BABYLON.Vector3(1.4, 0, -3),
    new BABYLON.Vector3(5.5, 0, -3),
    new BABYLON.Vector3(5.5, 0, 3),
    new BABYLON.Vector3(1.4, 0, 3)
  ];

  //Def emplacement fenêtre
  var fenArDef = [];
  fenArDef[0] = [
			new BABYLON.Vector3(3.7, 0, -1.8),
      new BABYLON.Vector3(4.5, 0, -1.8),
      new BABYLON.Vector3(4.5, 0, -0.3),
      new BABYLON.Vector3(3.7, 0, -0.3)
     ];
    fenArDef[1] = [
      new BABYLON.Vector3(1.9, 0, 0.75),
      new BABYLON.Vector3(2.7, 0, 0.75),
      new BABYLON.Vector3(2.7, 0, 2.55),
      new BABYLON.Vector3(1.9, 0, 2.55)
     ];
	fenArDef[2] = [
			new BABYLON.Vector3(4.2, 0, 0.75),
      new BABYLON.Vector3(5, 0, 0.75),
      new BABYLON.Vector3(5, 0, 2.55),
      new BABYLON.Vector3(4.2, 0, 2.55)
   ];

  //Création de l'obj mur
  var murAr = BABYLON.MeshBuilder.ExtrudePolygon("murAr", {shape:murArDef, depth: 0.1, holes: fenArDef}, scene);
  //rotation pour passer l'obj d'horizontale à vertical
  murAr.rotation.x = -Math.PI/2;
  //Placement du mur par rapport au mur avant
	murAr.position.z = 6.15;
  //Ajout texture mur
  murAr.material = murExt;
  //Généraion ombre pour la structure
  shadowGenerator.getShadowMap().renderList.push(murAr);
  murAr.receiveShadows = true;

  var murArDef2 = [
				new BABYLON.Vector3(-5.6, 0, -3),
        new BABYLON.Vector3(1.45, 0, -3),
        new BABYLON.Vector3(1.45, 0, 3),
        new BABYLON.Vector3(-2.075, 0, 5.5),
        new BABYLON.Vector3(-5.6, 0, 3)
      ];

  var fenArDef2 = [];
  fenArDef2[0] = [
      new BABYLON.Vector3(-5, 0, -1.8),
      new BABYLON.Vector3(-1.85, 0, -1.8),
      new BABYLON.Vector3(-1.85, 0, -0.3),
      new BABYLON.Vector3(-5, 0, -0.3)
   ];
  fenArDef2[1] = [
      new BABYLON.Vector3(-0.8, 0, -1.8),
      new BABYLON.Vector3(0.9, 0, -1.8),
      new BABYLON.Vector3(0.9, 0, -0.3),
      new BABYLON.Vector3(-0.8, 0, -0.3)
   ];
  fenArDef2[2] = [
      new BABYLON.Vector3(-5, 0, 0.75),
      new BABYLON.Vector3(-1.85, 0, 0.75),
      new BABYLON.Vector3(-1.85, 0, 2.55),
      new BABYLON.Vector3(-5, 0, 2.55)
   ];
  fenArDef2[3] = [
      new BABYLON.Vector3(-0.6, 0, 1.75),
      new BABYLON.Vector3(0.7, 0, 1.75),
      new BABYLON.Vector3(0.7, 0, 2.55),
      new BABYLON.Vector3(-0.6, 0, 2.55)
   ];

   //Création de l'obj mur 2
   var murAr2 = BABYLON.MeshBuilder.ExtrudePolygon("murAr2", {shape:murArDef2, depth: 0.1, holes: fenArDef2}, scene);
   //rotation pour passer l'obj d'horizontale à vertical
   murAr2.rotation.x = -Math.PI/2;
   //Placement du mur par rapport au mur avant
  	 murAr2.position.z = 9.15;
   //Ajout texture mur
   murAr2.material = murExt;
   //Généraion ombre pour la structure
   shadowGenerator.getShadowMap().renderList.push(murAr2);
   murAr2.receiveShadows = true;


 //Déf mur droite
  var murDroitDef = [
    new BABYLON.Vector3(-3.15, 0, -3),
    new BABYLON.Vector3(3.1, 0, -3),
    new BABYLON.Vector3(3.1, 0, 3),
    new BABYLON.Vector3(0, 0, 5.5),
    new BABYLON.Vector3(-3.15, 0, 3)
  ];

  //Création de l'obj mur
  var murDroit = BABYLON.MeshBuilder.ExtrudePolygon("murDroit", {shape:murDroitDef, depth: 0.1}, scene);
  //rotation pour passer l'obj d'horizontale à vertical et le tourné à 90°
  murDroit.rotation.z = -Math.PI/2;
  murDroit.rotation.x = -Math.PI/2;
  //Placement du mur par rapport au mur avant
  murDroit.position.x = 5.6;
  murDroit.position.z = 3.15;
  //Ajout texture mur
  murDroit.material = murExt;
  //Généraion ombre pour la structure
  shadowGenerator.getShadowMap().renderList.push(murDroit);
  murDroit.receiveShadows = true;

  var murDroitDef2 = [
    new BABYLON.Vector3(3.1, 0, -3),
    new BABYLON.Vector3(4.5, 0, -3),
    new BABYLON.Vector3(4.5, 0, -0.75),
    new BABYLON.Vector3(5.5, 0, -0.75),
    new BABYLON.Vector3(5.5, 0, -3),
    new BABYLON.Vector3(6, 0, -3),
    new BABYLON.Vector3(6, 0, 3),
    new BABYLON.Vector3(3.1, 0, 3)
  ];

  //Création de l'obj mur
  var murDroit2 = BABYLON.MeshBuilder.ExtrudePolygon("murDroit2", {shape:murDroitDef2, depth: 0.1}, scene);
  //rotation pour passer l'obj d'horizontale à vertical et le tourné à 90°
  murDroit2.rotation.z = -Math.PI/2;
  murDroit2.rotation.x = -Math.PI/2;
  //Placement du mur par rapport au mur avant
  murDroit2.position.x = 1.45;
  murDroit2.position.z = 3.15;
  //Ajout texture mur
  murDroit2.material = murExt;
  //Généraion ombre pour la structure
  shadowGenerator.getShadowMap().renderList.push(murDroit2);
  murDroit2.receiveShadows = true;


  //Déf mur Gauche
  var murGaucheDef = [
    new BABYLON.Vector3(-3.15, 0, -3),
    new BABYLON.Vector3(3.1, 0, -3),
    new BABYLON.Vector3(3.1, 0, 3),
    new BABYLON.Vector3(0, 0, 5.5),
    new BABYLON.Vector3(-3.15, 0, 3),
    new BABYLON.Vector3(3.1, 0, -3),
    new BABYLON.Vector3(6, 0, -3),
    new BABYLON.Vector3(6, 0, 3),
    new BABYLON.Vector3(3.1, 0, 3)
  ];

  //Création de l'obj mur
  var murGauche = BABYLON.MeshBuilder.ExtrudePolygon("murGauche", {shape:murGaucheDef, depth: 0.1}, scene);
  //rotation pour passer l'obj d'horizontale à vertical et le tourné à 90°
  murGauche.rotation.z = -Math.PI/2;
  murGauche.rotation.x = -Math.PI/2;
  //Placement du mur par rapport au mur avant
  murGauche.position.x = -5.50;
  murGauche.position.z = 3.14;
  //Ajout texture mur
  murGauche.material = murExt;
  //Généraion ombre pour la structure
  shadowGenerator.getShadowMap().renderList.push(murGauche);
  murGauche.receiveShadows = true;


  //Déf toit
  var toitDef = [
    new BABYLON.Vector3(-0.05, 0, 0),
		new BABYLON.Vector3(0.1, 0, 0),
		new BABYLON.Vector3(3.3, 0, 2.65),
		new BABYLON.Vector3(6.5, 0, 0),
		new BABYLON.Vector3(6.6, 0, 0),
		new BABYLON.Vector3(3.3, 0, 2.8)
  ];

  //Création de l'obj toit1
  var toit1 = BABYLON.MeshBuilder.ExtrudePolygon("toit1", {shape:toitDef, depth: 11.5}, scene);
  //rotation pour passer l'obj d'horizontale à vertical et le tourné à 90°
  toit1.rotation.z = -Math.PI/2;
  toit1.rotation.x = -Math.PI/2;
  //Placement du toit par rapport au mur avant
  toit1.position.x = 5.7;
	toit1.position.y = 2.9;
  toit1.position.z = -0.15;
  //Ajout texture toit
  toit1.material = toit;
  //Généraion ombre pour la structure
  shadowGenerator.getShadowMap().renderList.push(toit1);

  var toi2Def = [
    new BABYLON.Vector3(0, 0, 0),
		new BABYLON.Vector3(0.142, 0, 0),
		new BABYLON.Vector3(3.834, 0, 2.6),
		new BABYLON.Vector3(7.476, 0, 0),
		new BABYLON.Vector3(7.618, 0, 0),
		new BABYLON.Vector3(3.834, 0, 2.7)
  ];

  //Création de l'obj toit1
  var toit2 = BABYLON.MeshBuilder.ExtrudePolygon("toit2", {shape:toi2Def, depth: 3.2}, scene);
  //rotation pour passer l'obj d'horizontale à vertical et le tourné à 90°
  toit2.rotation.x = -Math.PI/2;
  //Placement du toit par rapport au mur avant
  toit2.position.x = -5.9;
	toit2.position.y = 2.9;
  toit2.position.z = 6.3;
  //Ajout texture toit
  toit2.material = toit;
  //Généraion ombre pour la structure
  shadowGenerator.getShadowMap().renderList.push(toit2);

  var toit3Def = [
    new BABYLON.Vector3(0.3, 0, 0.2),
		new BABYLON.Vector3(0.442, 0, 0.2),
		new BABYLON.Vector3(3.834, 0, 2.6),
		new BABYLON.Vector3(7.476, 0, 0),
		new BABYLON.Vector3(7.618, 0, 0),
		new BABYLON.Vector3(3.834, 0, 2.7)
  ];

  //Création de l'obj toit1
  var toit3 = BABYLON.MeshBuilder.ExtrudePolygon("toit3", {shape:toit3Def, depth: 3.2}, scene);
  //rotation pour passer l'obj d'horizontale à vertical et le tourné à 90°
  toit3.rotation.x = -Math.PI/2;
  //Placement du toit par rapport au mur avant
  toit3.position.x = -5.9;
  toit3.position.y = 2.9;
  toit3.position.z = 3.1;
  //Ajout texture toit
  toit3.material = toit;
  //Généraion ombre pour la structure
  shadowGenerator.getShadowMap().renderList.push(toit3);


  //Association de tout les toits en un objet
  var toitComplet = BABYLON.Mesh.MergeMeshes([toit1, toit2, toit3], true);


  //fonction escalier copier coller changement hauteur + position
  var stairsDepth = 2;
  var stairsHeight = 3.0;
  var stairsThickness = 0.05;
  var nBStairs = 12;
  var stairs = [];
  var x = 0;
  var z = 0;
  //up
  stairs.push(new BABYLON.Vector3(x, 0, z));
  z += stairsHeight/nBStairs - stairsThickness;
  stairs.push(new BABYLON.Vector3(x, 0, z));
  for(var i = 0; i<nBStairs; i++) {
      x += stairsDepth/nBStairs;
      stairs.push(new BABYLON.Vector3(x, 0, z));
      z += stairsHeight/nBStairs;
      stairs.push(new BABYLON.Vector3(x, 0, z));
  }
  x += stairsDepth/nBStairs - stairsThickness;
  stairs.push(new BABYLON.Vector3(x, 0, z));

  //down
  for(var i = 0; i<=nBStairs; i++) {
      x -= stairsDepth/nBStairs
      stairs.push(new BABYLON.Vector3(x, 0, z));
      z -= stairsHeight/nBStairs;
      stairs.push(new BABYLON.Vector3(x, 0, z));
  }

  var stairsWidth = 1.0;
  var stairCase = BABYLON.MeshBuilder.ExtrudePolygon("stairs", {shape:stairs, depth: stairsWidth}, scene);
  stairCase.position.x = 1.37;
  stairCase.position.y = -3.0;
  stairCase.position.z = 2.51;
  stairCase.rotation.x = -Math.PI/2;
  stairCase.rotation.y = -Math.PI/2;
  stairCase.material = sol;
  stairCase.receiveShadows = true;


  //Def Sol
  var solDef = [
    new BABYLON.Vector3(-5.5, 0, 0),
    new BABYLON.Vector3(5.5, 0, 0),
    new BABYLON.Vector3(5.5, 0, 6),
    new BABYLON.Vector3(1.345, 0, 6),
    new BABYLON.Vector3(1.345, 0, 9),
    new BABYLON.Vector3(-5.5, 0, 9)
  ];

  var espaceEsc = [];
  espaceEsc[0] = [
      new BABYLON.Vector3(0.27, 0, 2.5),
      new BABYLON.Vector3(0.27, 0, 4.5),
      new BABYLON.Vector3(1.37, 0, 4.5),
      new BABYLON.Vector3(1.37, 0, 2.5),
    ]

  //Création de l'obj sol1
  var sol1 = BABYLON.MeshBuilder.ExtrudePolygon("sol1", {shape:solDef, holes:espaceEsc, depth: 0.04}, scene);
  //Placement du sol par rapport au mur avant
  sol1.position.y = 0.21;
  sol1.position.z = 0.15;
  //Ajout texture sol
  sol1.material = sol;
  //Autorise l'affichage d'ombre sur la structure
  sol1.receiveShadows = true;

  var solDef2 = [
    new BABYLON.Vector3(-5.6, 0, -0.1),
    new BABYLON.Vector3(5.6, 0, -0.1),
    new BABYLON.Vector3(5.6, 0, 6.1),
    new BABYLON.Vector3(1.36, 0, 6.1),
    new BABYLON.Vector3(1.36, 0, 9.1),
    new BABYLON.Vector3(-5.6, 0, 9.1)
  ];

  //Création de l'obj sol2
  var sol2 = BABYLON.MeshBuilder.ExtrudePolygon("sol2", {shape:solDef2, holes:espaceEsc, depth: 0.04}, scene);
  //Placement du sol par rapport au mur avant
  sol2.position.y = -3;
  sol2.position.z = 0.15;
  //Ajout texture sol
  sol2.material = sol;
  //Autorise l'affichage d'ombre sur la structure
  sol2.receiveShadows = true;


  //Def plafond
  var plafondDef = [
    new BABYLON.Vector3(-5.5, 0, 0),
    new BABYLON.Vector3(5.5, 0, 0),
    new BABYLON.Vector3(5.5, 0, 6),
    new BABYLON.Vector3(1.345, 0, 6),
    new BABYLON.Vector3(1.345, 0, 9),
    new BABYLON.Vector3(-5.5, 0, 9)
  ];

  //Création de l'obj plafond1
  var plafond1 = BABYLON.MeshBuilder.ExtrudePolygon("plafond1", {shape:plafondDef, depth: 0.1}, scene);
  //Placement du plafond par rapport au mur avant
  plafond1.position.y = 2.8;
  plafond1.position.z = 0.15;
  //Ajout texture plafond
  plafond1.material = murInt;
  //Généraion ombre pour la structure
  shadowGenerator.getShadowMap().renderList.push(plafond1);

/*
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
*/
var murInt1 = [
          new BABYLON.Vector3(-3, 0, 0.6),
          new BABYLON.Vector3(-3, 0, 0),
          new BABYLON.Vector3(3, 0, 0),
          new BABYLON.Vector3(3, 0, 6.1),
          new BABYLON.Vector3(-3, 0, 6.1),
          new BABYLON.Vector3(-3, 0, 1.6),
          new BABYLON.Vector3(-1, 0, 1.6),
          new BABYLON.Vector3(-1, 0, 0.6),
        ];

        var porte = [];
        porte[0] = [
              new BABYLON.Vector3(0.1, 0, 1.6),
              new BABYLON.Vector3(0.1, 0, 0.6),
              new BABYLON.Vector3(2, 0, 0.6),
              new BABYLON.Vector3(2, 0, 1.6)
            ];

    var murInt1 = BABYLON.MeshBuilder.ExtrudePolygon("murInt1", {shape:murInt1, holes: porte, depth: 0.1}, scene);
    murInt1.rotation.z = Math.PI/2;
    murInt1.position.x = 1.35;
    murInt1.position.z = 0.15;
    //Généraion ombre pour la structure
    shadowGenerator.getShadowMap().renderList.push(murInt1);
    //Autorise l'affichage d'ombre sur la structure
    murInt1.receiveShadows = true;
    murInt1.material = murInt;

  ///Crée les corp de garde de l'esc
	var bannisterWallData = [
		new BABYLON.Vector3(0, 0, 0),
		new BABYLON.Vector3(3.5, 0, 0),
		new BABYLON.Vector3(3.5, 0, 3.2),
		new BABYLON.Vector3(1.5, 0, 3.2),
		new BABYLON.Vector3(0, 0, 0.75)
		];
	var spindleThickness = 0.05;
	var spindles = 12;
	var railGap = (1.5 - spindles * spindleThickness)/(spindles - 1);
	var rail = [];
	var ac = spindleThickness;
	for(var s = 0; s < spindles - 1; s++) {
		rail[s] = [];
		rail[s].push(new BABYLON.Vector3(ac, 0, 0.1 + 1.6 *ac));
		rail[s].push(new BABYLON.Vector3(ac, 0, (0.75 - spindleThickness) + 1.6 *ac));
		rail[s].push(new BABYLON.Vector3(ac + railGap, 0, (0.75 - spindleThickness) + 1.6 *(ac + railGap)));
		rail[s].push(new BABYLON.Vector3(ac + railGap, 0, 1.6 *(ac + railGap)));
		ac += spindleThickness + railGap;
	}

	var bannisterWall = BABYLON.MeshBuilder.ExtrudePolygon("bannisterWall", {shape:bannisterWallData, holes: rail, depth: 0.1}, scene);
	bannisterWall.rotation.x = -Math.PI/2;
	bannisterWall.rotation.z = -Math.PI/2;
	bannisterWall.position.x = 0.4;
	bannisterWall.position.y = -3;
	bannisterWall.position.z = 2.51;
  shadowGenerator.getShadowMap().renderList.push(bannisterWall);
  //Autorise l'affichage d'ombre sur la structure
  bannisterWall.receiveShadows = true;

	var bannister1Data = [
						new BABYLON.Vector3(0, 0, 0),
						new BABYLON.Vector3(2, 0, 0),
						new BABYLON.Vector3(2, 0, 0.75),
						new BABYLON.Vector3(0, 0, 0.75),
						];
	var spindle1Thickness = 0.05;
	var spindles1 = 12;
	var rail1Gap = (2 - spindles1 * spindle1Thickness)/(spindles1 - 1);
	var rail1 = [];
	var ac1 = spindle1Thickness;
	for(var s = 0; s < spindles1 - 1; s++) {
		rail1[s] = [];
		rail1[s].push(new BABYLON.Vector3(ac1, 0, spindle1Thickness));
		rail1[s].push(new BABYLON.Vector3(ac1, 0, 0.75 - spindle1Thickness));
		rail1[s].push(new BABYLON.Vector3(ac1 + rail1Gap, 0, 0.75 - spindle1Thickness));
		rail1[s].push(new BABYLON.Vector3(ac1 + rail1Gap, 0, spindle1Thickness));
		ac1 += spindle1Thickness + rail1Gap;
	}

	var bannister1 = BABYLON.MeshBuilder.ExtrudePolygon("bannister1", {shape:bannister1Data, holes: rail1, depth: 0.1}, scene);
	bannister1.rotation.x = -Math.PI/2;
	bannister1.rotation.z = -Math.PI/2;
	bannister1.position.x = 0.3;
	bannister1.position.y = 0.2;
	bannister1.position.z = 2.61;
  shadowGenerator.getShadowMap().renderList.push(bannister1);
  //Autorise l'affichage d'ombre sur la structure
  bannister1.receiveShadows = true;

	var bannister2Data = [
						new BABYLON.Vector3(0, 0, 0),
						new BABYLON.Vector3(1, 0, 0),
						new BABYLON.Vector3(1, 0, 0.75),
						new BABYLON.Vector3(0, 0, 0.75),
						];
	var spindle2Thickness = 0.05;
	var spindles2 = 6;
	var rail2Gap = (1- spindles2 * spindle2Thickness)/(spindles2 - 1);
	var rail2 = [];
	var ac2 = spindle2Thickness;
	for(var s = 0; s < spindles2 - 1; s++) {
		rail2[s] = [];
		rail2[s].push(new BABYLON.Vector3(ac2, 0, spindle2Thickness));
		rail2[s].push(new BABYLON.Vector3(ac2, 0, 0.75 - spindle2Thickness));
		rail2[s].push(new BABYLON.Vector3(ac2 + rail2Gap, 0, 0.75 - spindle2Thickness));
		rail2[s].push(new BABYLON.Vector3(ac2 + rail2Gap, 0, spindle2Thickness));
		ac2 += spindle2Thickness + rail2Gap;
	}

	var bannister2 = BABYLON.MeshBuilder.ExtrudePolygon("bannister2", {shape:bannister2Data, holes: rail2, depth: 0.1}, scene);
	bannister2.rotation.x = -Math.PI/2;
	bannister2.position.x = 0.3;
	bannister2.position.y = 0.2;
	bannister2.position.z = 2.61;
  shadowGenerator.getShadowMap().renderList.push(bannister2);
  //Autorise l'affichage d'ombre sur la structure
  bannister2.receiveShadows = true;


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

  	var fenAv1 = windowMaker(3.2, 2, 4, 0.15, 0.1);
  	fenAv1.position.x = -4.78;
  	fenAv1.position.y = -2.3;
  	fenAv1.position.z = 0.1;
    shadowGenerator.getShadowMap().renderList.push(fenAv1);

  	var fenAv2 = windowMaker(3.2, 2, 4, 0.15, 0.1);
  	fenAv2.position.x = 1.58;
  	fenAv2.position.y = -2.3;
  	fenAv2.position.z = 0.1;
    shadowGenerator.getShadowMap().renderList.push(fenAv2);

  	var fenAv3 = windowMaker(1.9, 1.8, 2, 0.15, 0.1);
  	fenAv3.position.x = -4.03;
  	fenAv3.position.y = 0.75;
  	fenAv3.position.z = 0.1;
    shadowGenerator.getShadowMap().renderList.push(fenAv3);

  	var fenAv4 = windowMaker(1.9, 1.8, 2, 0.15, 0.1);
  	fenAv4.position.x = 2.13;
  	fenAv4.position.y = 0.75;
  	fenAv4.position.z = 0.1;
    shadowGenerator.getShadowMap().renderList.push(fenAv4);

  	var fenAv5 = windowMaker(1.3, 1.8, 2, 0.15, 0.1);
  	fenAv5.position.x = -0.65;
  	fenAv5.position.y = 0.75;
  	fenAv5.position.z = 0.1;
    shadowGenerator.getShadowMap().renderList.push(fenAv5);

  	var fenAr1 = windowMaker(3.15, 1.5, 4, 0.15, 0.1);
  	fenAr1.position.x = -5;
  	fenAr1.position.y = -1.8;
  	fenAr1.position.z = 9;
    shadowGenerator.getShadowMap().renderList.push(fenAr1);

  	var fenAr2 = windowMaker(1.7, 1.5, 2, 0.15, 0.1);
  	fenAr2.position.x = -0.8;
  	fenAr2.position.y = -1.8;
  	fenAr2.position.z = 9;
    shadowGenerator.getShadowMap().renderList.push(fenAr2);

  	var fenDroite1 = windowMaker(3.15, 1.8, 4, 0.15, 0.1);
  	fenDroite1.position.x = -5;
  	fenDroite1.position.y = 0.75;
  	fenDroite1.position.z = 9;
    shadowGenerator.getShadowMap().renderList.push(fenDroite1);

  	var fenDroite2 = windowMaker(1.3, 0.8, 1, 0.15, 0.1);
  	fenDroite2.position.x = -0.6;
  	fenDroite2.position.y = 1.75;
  	fenDroite2.position.z = 9;
    shadowGenerator.getShadowMap().renderList.push(fenDroite2);

  	var fenDroite3 = windowMaker(0.8, 1.5, 1, 0.15, 0.1);
  	fenDroite3.position.x = 3.7;
  	fenDroite3.position.y = -1.8;
  	fenDroite3.position.z = 6;
    shadowGenerator.getShadowMap().renderList.push(fenDroite3);

  	var fenDroite4 = windowMaker(0.8, 1.8, 1, 0.15, 0.1);
  	fenDroite4.position.x = 1.9;
  	fenDroite4.position.y = 0.75;
  	fenDroite4.position.z = 6;
    shadowGenerator.getShadowMap().renderList.push(fenDroite4);

  	var fenDroite5 = windowMaker(0.8, 1.8, 1, 0.15, 0.1);
  	fenDroite5.position.x = 4.2;
  	fenDroite5.position.y = 0.75;
  	fenDroite5.position.z = 6;
    shadowGenerator.getShadowMap().renderList.push(fenDroite5);

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

  var porteMurAr = doorMaker(1, 2.25, 0.1, 0.05);
  porteMurAr.rotation.y = Math.PI/2;
  porteMurAr.position.x = 1.3;
  porteMurAr.position.y = -3;
  porteMurAr.position.z = 8.65;
  shadowGenerator.getShadowMap().renderList.push(porteMurAr);

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
  		fenAv1.isVisible = true;
      fenAv2.isVisible = true;
      fenAv3.isVisible = true;
      fenAv4.isVisible = true;
      fenAv5.isVisible = true;
  		porteMurAv.isVisible = true;
    }
    else {
		checkboxMurAv.color = "red";
		murAv.isVisible = false;
    fenAv1.isVisible = false;
    fenAv2.isVisible = false;
    fenAv3.isVisible = false;
    fenAv4.isVisible = false;
    fenAv5.isVisible = false;
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
      murAr2.isVisible = true;
      fenAr1.isVisible = true;
      fenAr2.isVisible = true;
      fenDroite1.isVisible = true;
      fenDroite2.isVisible = true;
      fenDroite3.isVisible = true;
      fenDroite4.isVisible = true;
      fenDroite5.isVisible = true;
    }
  	else {
  		checkboxMurAr.color = "red";
  		murAr.isVisible = false;
      murAr2.isVisible = false;
      fenAr1.isVisible = false;
      fenAr2.isVisible = false;
      fenDroite1.isVisible = false;
      fenDroite2.isVisible = false;
      fenDroite3.isVisible = false;
      fenDroite4.isVisible = false;
      fenDroite5.isVisible = false;
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
      murDroit2.isVisible = true;
      porteMurAr.isVisible = true;
    }
  	else {
  		checkboxMurDroit.color = "red";
  		murDroit.isVisible = false;
      murDroit2.isVisible = false;
      porteMurAr.isVisible = false;
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
    }
  	else {
  		checkboxMurGauche.color = "red";
  		murGauche.isVisible = false;
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

  document.getElementById("canvasUp").addEventListener("click",function () {
    panel.isVisible = true;
  })
  document.getElementById("canvasDown").addEventListener("click",function () {
    panel.isVisible = false;
  })
  panel.isVisible = false;

  //Fin return graphic
  return scene;
}
