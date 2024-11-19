<!DOCTYPE html>
<html>
<head>
	<title>Login Ata</title>
	<link rel="stylesheet" type="text/css" href="slide navbar style.css">
	<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
	<style>
		body {
			margin: 0;
			padding: 0;
			font-family: 'Jost', sans-serif;
			background: linear-gradient(to bottom,#a00303, #290c0c, #111111, #3e2424);
		}
		.header {
			background:#111111;
			overflow: hidden;
			box-shadow: 5px 20px 50px #000;
			width: 100%;
			padding: 30px 0;
		}
		.container {
			display: flex;
			justify-content: center;
			align-items: center;
			min-height: calc(100vh - 80px); 
		}
		label {
			color: #fff;
			font-size: 2.3em;
			justify-content: center;
			display: flex;
			margin: 50px;
			font-weight: bold;
			cursor: pointer;
			transition: .5s ease-in-out;
		}
		input {
			width: 60%;
			height: 40px;
			background: #e0dede;
			justify-content: center;
			display: flex;
			margin: 20px auto;
			padding: 12px;
			border: none;
			outline: none;
			border-radius: 5px;
		}
		button {
			width: 60%;
			height: 40px;
			margin: 10px auto;
			justify-content: center;
			display: block;
			color: #fff;
			background: #a00303;
			font-size: 1em;
			font-weight: bold;
			margin-top: 30px;
			outline: none;
			border: none;
			border-radius: 5px;
			transition: .2s ease-in;
			cursor: pointer;
		}
		button:hover {
			background: #dc143c;
		}
        .pginicial{
            font-size: 25px;
            margin-left: 15px;
            color: #e0dede;
            transition: all ease 0.3s;
            background-color: #a00303;
            border: #a00303 solid 10px ;
            border-radius: 30px;
			cursor: pointer;
        }
        .pginicial:hover{
            color:#e0dede;
            scale: 1.2  ;
            border-radius: 10px;
            background-color: #dc143c;
            border: #dc143c solid 10px ;
            transition: all ease 0.3s;
        }
        .conta{
            font-size: 25px;
            margin-left: 15px;
            color: #e0dede;
            transition: all ease 0.3s;
            background-color: #a00303;
            border: #a00303 solid 10px ;
            border-radius: 30px;
			background-image: url('account.png');
			background-size: contain;
			background-repeat: no-repeat;
			background-position: center;
		margin-left: 69%;	 
		cursor: pointer;
        }
        .conta:hover{
            color:#e0dede;
            scale: 1.2  ;
            border-radius: 10px;
            background-color: #dc143c;
            border: #dc143c solid 10px ;
            transition: all ease 0.3s;
        }
	</style>
</head>
<body>
	<div class="header">
		<a class="pginicial" href="index.html">ATA FOCUS SYSTEM</a>
		<a class="pginicial" href="index.html">eventos</a>
		<a class="pginicial" href="index.html">horarios</a>
		<a class="conta">⠀⠀</a>
	</div>
	<div class="container">

	</div>
</body>
</html>
