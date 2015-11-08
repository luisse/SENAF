//CARGA TODOS LOS CONTROLADORES AUTOMATICAMENTE
./Console/cake AclExtras.AclExtras aco_sync
sh lib/Cake/Console/cake AclExtras.AclExtras recover aro
/*Users*/
sh lib/Cake/Console/cake acl create aco controllers Users
sh lib/Cake/Console/cake acl create aco Users index
sh lib/Cake/Console/cake acl create aco Users login
sh lib/Cake/Console/cake acl create aco Users logout
sh lib/Cake/Console/cake acl create aco Users confirmmail
sh lib/Cake/Console/cake acl create aco Users add
sh lib/Cake/Console/cake acl create aco Users delete
sh lib/Cake/Console/cake acl create aco Users edit
sh lib/Cake/Console/cake acl create aco Users buscarclientes
sh lib/Cake/Console/cake acl create aco Users verdetalleusuario
sh lib/Cake/Console/cake acl create aco Users userajaxlogin
sh lib/Cake/Console/cake acl create aco Users userajaxloginremote
sh lib/Cake/Console/cake acl create aco Users addcliente
sh lib/Cake/Console/cake acl create aco Users usersactive
sh lib/Cake/Console/cake acl create aco Users confirmarusuario
sh lib/Cake/Console/cake acl create aco Users emailmensaje
sh lib/Cake/Console/cake acl create aco Users valdelete
sh lib/Cake/Console/cake acl create aco Users cambiarcontrasenia
sh lib/Cake/Console/cake acl create aco Users mostrarusuario
sh lib/Cake/Console/cake acl create aco Users cambiarcontraseniauser
sh lib/Cake/Console/cake acl create aco Users listusers
sh lib/Cake/Console/cake acl create aco Users addusuario
sh lib/Cake/Console/cake acl create aco Users editimage
sh lib/Cake/Console/cake acl create aco Users mostrarfoto
/*Afinidades*/
sh lib/Cake/Console/cake acl create aco controllers Afinidades
sh lib/Cake/Console/cake acl create aco Afinidades index
sh lib/Cake/Console/cake acl create aco Afinidades view
sh lib/Cake/Console/cake acl create aco Afinidades add
sh lib/Cake/Console/cake acl create aco Afinidades edit
sh lib/Cake/Console/cake acl create aco Afinidades delete
/*Archivos*/
sh lib/Cake/Console/cake acl create aco controllers Archivos
sh lib/Cake/Console/cake acl create aco Archivos index
sh lib/Cake/Console/cake acl create aco Archivos view
sh lib/Cake/Console/cake acl create aco Archivos add
sh lib/Cake/Console/cake acl create aco Archivos edit
sh lib/Cake/Console/cake acl create aco Archivos delete
sh lib/Cake/Console/cake acl create aco Archivos verarchivo
sh lib/Cake/Console/cake acl create aco Archivos listarchivos
sh lib/Cake/Console/cake acl create aco Archivos tomarfotopersona
/*Archxpersonas*/
sh lib/Cake/Console/cake acl create aco controllers Archxpersonas
sh lib/Cake/Console/cake acl create aco Archxpersonas index
sh lib/Cake/Console/cake acl create aco Archxpersonas view
sh lib/Cake/Console/cake acl create aco Archxpersonas add
sh lib/Cake/Console/cake acl create aco Archxpersonas edit
sh lib/Cake/Console/cake acl create aco Archxpersonas delete
/*Barrios*/
sh lib/Cake/Console/cake acl create aco controllers Barrios
sh lib/Cake/Console/cake acl create aco Barrios retornalxmlbarrios
/*Calles*/
sh lib/Cake/Console/cake acl create aco controllers Calles
sh lib/Cake/Console/cake acl create aco Calles index
sh lib/Cake/Console/cake acl create aco Calles view
sh lib/Cake/Console/cake acl create aco Calles add
sh lib/Cake/Console/cake acl create aco Calles edit
sh lib/Cake/Console/cake acl create aco Calles delete
sh lib/Cake/Console/cake acl create aco Calles autocompletarcalle
/*Departamentos*/
sh lib/Cake/Console/cake acl create aco controllers Departamentos
sh lib/Cake/Console/cake acl create aco Departamentos retornalxmldepartamentos
/*Deptos*/
sh lib/Cake/Console/cake acl create aco controllers Deptos
sh lib/Cake/Console/cake acl create aco Deptos retornalxmldeptos
/*Domicilios*/
sh lib/Cake/Console/cake acl create aco controllers Domicilios
sh lib/Cake/Console/cake acl create aco Domicilios index
sh lib/Cake/Console/cake acl create aco Domicilios view
sh lib/Cake/Console/cake acl create aco Domicilios add
sh lib/Cake/Console/cake acl create aco Domicilios edit
sh lib/Cake/Console/cake acl create aco Domicilios delete
/*Estciviles*/
sh lib/Cake/Console/cake acl create aco controllers Estciviles
sh lib/Cake/Console/cake acl create aco Estciviles index
sh lib/Cake/Console/cake acl create aco Estciviles view
sh lib/Cake/Console/cake acl create aco Estciviles add
sh lib/Cake/Console/cake acl create aco Estciviles edit
sh lib/Cake/Console/cake acl create aco Estciviles delete
/*Grupopersonas*/
sh lib/Cake/Console/cake acl create aco controllers Grupopersonas
sh lib/Cake/Console/cake acl create aco Grupopersonas index
sh lib/Cake/Console/cake acl create aco Grupopersonas view
sh lib/Cake/Console/cake acl create aco Grupopersonas add
sh lib/Cake/Console/cake acl create aco Grupopersonas edit
sh lib/Cake/Console/cake acl create aco Grupopersonas delete
/*Grupsociales*/
sh lib/Cake/Console/cake acl create aco controllers Grupsociales
sh lib/Cake/Console/cake acl create aco Grupsociales index
sh lib/Cake/Console/cake acl create aco Grupsociales view
sh lib/Cake/Console/cake acl create aco Grupsociales add
sh lib/Cake/Console/cake acl create aco Grupsociales edit
sh lib/Cake/Console/cake acl create aco Grupsociales delete
/*Grupsocxdomis*/
sh lib/Cake/Console/cake acl create aco controllers Grupsocxdomis
sh lib/Cake/Console/cake acl create aco Grupsocxdomis index
sh lib/Cake/Console/cake acl create aco Grupsocxdomis view
sh lib/Cake/Console/cake acl create aco Grupsocxdomis add
sh lib/Cake/Console/cake acl create aco Grupsocxdomis edit
sh lib/Cake/Console/cake acl create aco Grupsocxdomis delete
/*Localidades*/
sh lib/Cake/Console/cake acl create aco controllers Localidades
sh lib/Cake/Console/cake acl create aco Localidades retornalxmllocalidades
/*Municipios*/
sh lib/Cake/Console/cake acl create aco controllers Municipios
sh lib/Cake/Console/cake acl create aco Municipios retornalxmldeptos
/*Oficinas*/
sh lib/Cake/Console/cake acl create aco controllers Oficinas
sh lib/Cake/Console/cake acl create aco Oficinas index
sh lib/Cake/Console/cake acl create aco Oficinas view
sh lib/Cake/Console/cake acl create aco Oficinas add
sh lib/Cake/Console/cake acl create aco Oficinas edit
sh lib/Cake/Console/cake acl create aco Oficinas delete
/*Parentescos*/
sh lib/Cake/Console/cake acl create aco controllers Parentescos
sh lib/Cake/Console/cake acl create aco Parentescos index
sh lib/Cake/Console/cake acl create aco Parentescos view
sh lib/Cake/Console/cake acl create aco Parentescos add
sh lib/Cake/Console/cake acl create aco Parentescos edit
sh lib/Cake/Console/cake acl create aco Parentescos delete
/*Permisos*/
sh lib/Cake/Console/cake acl create aco controllers Permisos
sh lib/Cake/Console/cake acl create aco Permisos index
sh lib/Cake/Console/cake acl create aco Permisos view
sh lib/Cake/Console/cake acl create aco Permisos add
sh lib/Cake/Console/cake acl create aco Permisos edit
sh lib/Cake/Console/cake acl create aco Permisos delete
/*Personas*/
sh lib/Cake/Console/cake acl create aco controllers Personas
sh lib/Cake/Console/cake acl create aco Personas index
sh lib/Cake/Console/cake acl create aco Personas view
sh lib/Cake/Console/cake acl create aco Personas add
sh lib/Cake/Console/cake acl create aco Personas edit
sh lib/Cake/Console/cake acl create aco Personas delete
sh lib/Cake/Console/cake acl create aco Personas listpersonas
sh lib/Cake/Console/cake acl create aco Personas listpersonassel
sh lib/Cake/Console/cake acl create aco Personas getlocalize
sh lib/Cake/Console/cake acl create aco Personas seleccionarpersonasgrupo
sh lib/Cake/Console/cake acl create aco Personas seleccionarclientegrupsociale
sh lib/Cake/Console/cake acl create aco Personas seleccionarpersonasvinculos
sh lib/Cake/Console/cake acl create aco Personas sissegpersona
sh lib/Cake/Console/cake acl create aco Personas mostrarseguimiento
sh lib/Cake/Console/cake acl create aco Personas personaexiste
sh lib/Cake/Console/cake acl create aco Personas getpersona
sh lib/Cake/Console/cake acl create aco Personas seguimientopersonas
/*Persxgrupsociales*/
sh lib/Cake/Console/cake acl create aco controllers Persxgrupsociales
sh lib/Cake/Console/cake acl create aco Persxgrupsociales index
sh lib/Cake/Console/cake acl create aco Persxgrupsociales view
sh lib/Cake/Console/cake acl create aco Persxgrupsociales add
sh lib/Cake/Console/cake acl create aco Persxgrupsociales edit
sh lib/Cake/Console/cake acl create aco Persxgrupsociales delete
sh lib/Cake/Console/cake acl create aco Persxgrupsociales borrarpersona
sh lib/Cake/Console/cake acl create aco Persxgrupsociales agregarfila
sh lib/Cake/Console/cake acl create aco Persxgrupsociales existepersonagrupo
sh lib/Cake/Console/cake acl create aco Persxgrupsociales modificargrupopersona
sh lib/Cake/Console/cake acl create aco Persxgrupsociales editgrupsave
/*Persxoficinas*/
sh lib/Cake/Console/cake acl create aco controllers Persxoficinas
sh lib/Cake/Console/cake acl create aco Persxoficinas index
sh lib/Cake/Console/cake acl create aco Persxoficinas view
sh lib/Cake/Console/cake acl create aco Persxoficinas add
sh lib/Cake/Console/cake acl create aco Persxoficinas edit
sh lib/Cake/Console/cake acl create aco Persxoficinas delete
sh lib/Cake/Console/cake acl create aco Persxoficinas listperxoficinas
sh lib/Cake/Console/cake acl create aco Persxoficinas agregarfila
sh lib/Cake/Console/cake acl create aco Persxoficinas existepersonagrupo
/*Persxparentescos*/
sh lib/Cake/Console/cake acl create aco controllers Persxparentescos
sh lib/Cake/Console/cake acl create aco Persxparentescos index
sh lib/Cake/Console/cake acl create aco Persxparentescos view
sh lib/Cake/Console/cake acl create aco Persxparentescos add
sh lib/Cake/Console/cake acl create aco Persxparentescos edit
sh lib/Cake/Console/cake acl create aco Persxparentescos delete
/*Persxparentescos*/
sh lib/Cake/Console/cake acl create aco controllers Persxparentescos
sh lib/Cake/Console/cake acl create aco Provincias retornalxmlprovincias
sh lib/Cake/Console/cake acl create aco Provincias retornalxmlprovincias
/*Tiparchivos*/
sh lib/Cake/Console/cake acl create aco controllers Tiparchivos
sh lib/Cake/Console/cake acl create aco Tiparchivos index
sh lib/Cake/Console/cake acl create aco Tiparchivos view
sh lib/Cake/Console/cake acl create aco Tiparchivos add
sh lib/Cake/Console/cake acl create aco Tiparchivos edit
sh lib/Cake/Console/cake acl create aco Tiparchivos delete
/*Tipdocxpers*/
sh lib/Cake/Console/cake acl create aco controllers Tipdocxpers
sh lib/Cake/Console/cake acl create aco Tipdocxpers index
sh lib/Cake/Console/cake acl create aco Tipdocxpers view
sh lib/Cake/Console/cake acl create aco Tipdocxpers add
sh lib/Cake/Console/cake acl create aco Tipdocxpers edit
sh lib/Cake/Console/cake acl create aco Tipdocxpers delete
/*Tipodocs*/
sh lib/Cake/Console/cake acl create aco controllers Tipodocs
sh lib/Cake/Console/cake acl create aco Tipodocs index
sh lib/Cake/Console/cake acl create aco Tipodocs view
sh lib/Cake/Console/cake acl create aco Tipodocs add
sh lib/Cake/Console/cake acl create aco Tipodocs edit
sh lib/Cake/Console/cake acl create aco Tipodocs delete
/*Tipofamilias*/
sh lib/Cake/Console/cake acl create aco controllers Tipofamilias
sh lib/Cake/Console/cake acl create aco Tipofamilias index
sh lib/Cake/Console/cake acl create aco Tipofamilias view
sh lib/Cake/Console/cake acl create aco Tipofamilias add
sh lib/Cake/Console/cake acl create aco Tipofamilias edit
sh lib/Cake/Console/cake acl create aco Tipofamilias delete
/*Tipopersonas*/
sh lib/Cake/Console/cake acl create aco controllers Tipopersonas
sh lib/Cake/Console/cake acl create aco Tipopersonas index
sh lib/Cake/Console/cake acl create aco Tipopersonas view
sh lib/Cake/Console/cake acl create aco Tipopersonas add
sh lib/Cake/Console/cake acl create aco Tipopersonas edit
sh lib/Cake/Console/cake acl create aco Tipopersonas delete
/*Vinculopers*/
sh lib/Cake/Console/cake acl create aco controllers Vinculopers
sh lib/Cake/Console/cake acl create aco Vinculopers index
sh lib/Cake/Console/cake acl create aco Vinculopers view
sh lib/Cake/Console/cake acl create aco Vinculopers add
sh lib/Cake/Console/cake acl create aco Vinculopers edit
sh lib/Cake/Console/cake acl create aco Vinculopers delete
sh lib/Cake/Console/cake acl create aco Vinculopers listvinculopers
sh lib/Cake/Console/cake acl create aco Vinculopers agregarfila
sh lib/Cake/Console/cake acl create aco Vinculopers existepersonagrupo
/*Vinculos*/
sh lib/Cake/Console/cake acl create aco controllers Vinculos
sh lib/Cake/Console/cake acl create aco Vinculos index
sh lib/Cake/Console/cake acl create aco Vinculos view
sh lib/Cake/Console/cake acl create aco Vinculos add
sh lib/Cake/Console/cake acl create aco Vinculos edit
sh lib/Cake/Console/cake acl create aco Vinculos delete
/*Buttonusers*/
sh lib/Cake/Console/cake acl create aco controllers Buttonusers
sh lib/Cake/Console/cake acl create aco Buttonusers index
sh lib/Cake/Console/cake acl create aco Buttonusers view
sh lib/Cake/Console/cake acl create aco Buttonusers add
sh lib/Cake/Console/cake acl create aco Buttonusers edit
sh lib/Cake/Console/cake acl create aco Buttonusers delete
sh lib/Cake/Console/cake acl create aco Buttonusers addbuttongrup
/*Userbuttongets*/
sh lib/Cake/Console/cake acl create aco controllers Userbuttongets
sh lib/Cake/Console/cake acl create aco Userbuttongets index
sh lib/Cake/Console/cake acl create aco Userbuttongets view
sh lib/Cake/Console/cake acl create aco Userbuttongets add
sh lib/Cake/Console/cake acl create aco Userbuttongets edit
sh lib/Cake/Console/cake acl create aco Userbuttongets delete
/*Ccrfallecidos*/
sh lib/Cake/Console/cake acl create aco controllers Ccrfallecidos
sh lib/Cake/Console/cake acl create aco Ccrfallecidos index
sh lib/Cake/Console/cake acl create aco Ccrfallecidos cargarsepelioscvs
sh lib/Cake/Console/cake acl create aco Ccrfallecidos procesarcvs
sh lib/Cake/Console/cake acl create aco Ccrfallecidos guardarccrfallecidos
sh lib/Cake/Console/cake acl create aco Ccrfallecidos listccrfallecidos
