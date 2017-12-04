define({ "api": [
  {
    "type": "any",
    "url": "/HabilitarCORS4200/",
    "title": "HabilitarCORS4200",
    "version": "0.1.0",
    "name": "HabilitarCORS4200",
    "group": "MIDDLEWARE",
    "description": "<p>Por medio de este MiddleWare habilito que se pueda acceder desde http://localhost:4200</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "ServerRequestInterface",
            "optional": false,
            "field": "request",
            "description": "<p>El objeto REQUEST.</p>"
          },
          {
            "group": "Parameter",
            "type": "ResponseInterface",
            "optional": false,
            "field": "response",
            "description": "<p>El objeto RESPONSE.</p>"
          },
          {
            "group": "Parameter",
            "type": "Callable",
            "optional": false,
            "field": "next",
            "description": "<p>The next middleware callable.</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Como usarlo:",
        "content": "->add(\\verificador::class . ':HabilitarCORS4200')",
        "type": "json"
      }
    ],
    "filename": "./API/PHP/API/MWparaCORS.php",
    "groupTitle": "MIDDLEWARE"
  },
  {
    "type": "any",
    "url": "/HabilitarCORS8080/",
    "title": "HabilitarCORS8080",
    "version": "0.1.0",
    "name": "HabilitarCORS8080",
    "group": "MIDDLEWARE",
    "description": "<p>Por medio de este MiddleWare habilito que se pueda acceder desde http://localhost:8080</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "ServerRequestInterface",
            "optional": false,
            "field": "request",
            "description": "<p>El objeto REQUEST.</p>"
          },
          {
            "group": "Parameter",
            "type": "ResponseInterface",
            "optional": false,
            "field": "response",
            "description": "<p>El objeto RESPONSE.</p>"
          },
          {
            "group": "Parameter",
            "type": "Callable",
            "optional": false,
            "field": "next",
            "description": "<p>The next middleware callable.</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Como usarlo:",
        "content": "->add(\\verificador::class . ':HabilitarCORS8080')",
        "type": "json"
      }
    ],
    "filename": "./API/PHP/API/MWparaCORS.php",
    "groupTitle": "MIDDLEWARE"
  },
  {
    "type": "any",
    "url": "/HabilitarCORSTodos/",
    "title": "HabilitarCORSTodos",
    "version": "0.1.0",
    "name": "HabilitarCORSTodos",
    "group": "MIDDLEWARE",
    "description": "<p>Por medio de este MiddleWare habilito que se pueda acceder desde cualquier servidor</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "ServerRequestInterface",
            "optional": false,
            "field": "request",
            "description": "<p>El objeto REQUEST.</p>"
          },
          {
            "group": "Parameter",
            "type": "ResponseInterface",
            "optional": false,
            "field": "response",
            "description": "<p>El objeto RESPONSE.</p>"
          },
          {
            "group": "Parameter",
            "type": "Callable",
            "optional": false,
            "field": "next",
            "description": "<p>The next middleware callable.</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Como usarlo:",
        "content": "->add(\\verificador::class . ':HabilitarCORSTodos')",
        "type": "json"
      }
    ],
    "filename": "./API/PHP/API/MWparaCORS.php",
    "groupTitle": "MIDDLEWARE"
  },
  {
    "type": "any",
    "url": "/adminValidationMiddleware/",
    "title": "adminValidationMiddleware",
    "version": "0.1.0",
    "name": "adminValidationMiddleware",
    "group": "MIDDLEWARE",
    "description": "<p>Por medio de este MiddleWare valido que el contenido de los servicios solamente pueda ser visto por un admin</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "ServerRequestInterface",
            "optional": false,
            "field": "request",
            "description": "<p>El objeto REQUEST.</p>"
          },
          {
            "group": "Parameter",
            "type": "ResponseInterface",
            "optional": false,
            "field": "response",
            "description": "<p>El objeto RESPONSE.</p>"
          },
          {
            "group": "Parameter",
            "type": "Callable",
            "optional": false,
            "field": "next",
            "description": "<p>The next middleware callable.</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Como usarlo:",
        "content": "->add(\\validationAPI::class . ':adminValidationMiddleware')",
        "type": "json"
      }
    ],
    "filename": "./API/PHP/API/validationAPI.php",
    "groupTitle": "MIDDLEWARE"
  },
  {
    "type": "any",
    "url": "/usuarioLogeadoValidationMiddleware/",
    "title": "usuarioLogeadoValidationMiddleware",
    "version": "0.1.0",
    "name": "usuarioLogeadoValidationMiddleware",
    "group": "MIDDLEWARE",
    "description": "<p>Por medio de este MiddleWare valido que el contenido de los servicios solamente pueda ser visto por un usuario logeado</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "ServerRequestInterface",
            "optional": false,
            "field": "request",
            "description": "<p>El objeto REQUEST.</p>"
          },
          {
            "group": "Parameter",
            "type": "ResponseInterface",
            "optional": false,
            "field": "response",
            "description": "<p>El objeto RESPONSE.</p>"
          },
          {
            "group": "Parameter",
            "type": "Callable",
            "optional": false,
            "field": "next",
            "description": "<p>The next middleware callable.</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Como usarlo:",
        "content": "->add(\\validationAPI::class . ':usuarioLogeadoValidationMiddleware')",
        "type": "json"
      }
    ],
    "filename": "./API/PHP/API/validationAPI.php",
    "groupTitle": "MIDDLEWARE"
  },
  {
    "type": "post",
    "url": "/cocheras",
    "title": "Busqueda",
    "version": "0.1.0",
    "name": "busqueda",
    "group": "cocheraAPI",
    "description": "<p>Trae las cocheras mas usadas, menos usadas, y sin usar desde siempre o de una fecha/rango de fechas determinado</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Date",
            "optional": true,
            "field": "fechaInicio",
            "description": "<p>Opcional, filtro de fecha, si no se especifica &quot;fechaFin&quot;, se filtra por esta fecha solamente. Formato 'yyyy/MM/dd'</p>"
          },
          {
            "group": "Parameter",
            "type": "Date",
            "optional": true,
            "field": "fechaFin",
            "description": "<p>Opcional, filtro de fecha, si se especifica, se filtra en el rango entre fechaInicio y este. Formato 'yyyy/MM/dd'</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Como usarlo:",
        "content": "->post('[/]', \\cocheraAPI::class . ':busqueda')",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object[]",
            "optional": false,
            "field": "MasUsados",
            "description": "<p>Un array con el nombre y cantidad de las cocheras mas usadas</p>"
          },
          {
            "group": "Success 200",
            "type": "Object[]",
            "optional": false,
            "field": "MenosUsados",
            "description": "<p>Un array con el nombre y cantidad de las cocheras menos usadas</p>"
          },
          {
            "group": "Success 200",
            "type": "Object[]",
            "optional": false,
            "field": "SinUsar",
            "description": "<p>Un array con el nombre y cantidad de las cocheras sin usar</p>"
          }
        ]
      }
    },
    "error": {
      "examples": [
        {
          "title": "Parametros erroneos:",
          "content": "{\n   \"Estado\" => \"Error\",\n   \"Mensaje\" => \"Error en los parametros\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./API/PHP/API/cocheraAPI.php",
    "groupTitle": "cocheraAPI"
  },
  {
    "type": "delete",
    "url": "/empleados",
    "title": "BorrarUno",
    "version": "0.1.0",
    "name": "BorrarUno",
    "group": "empleadoAPI",
    "description": "<p>(Admin) Da de baja un empleado</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Id del empleado a dar de baja</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Como usarlo:",
        "content": "->delete('[/]', \\empleadoAPI::class . ':BorrarUno')",
        "type": "json"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Baja exitosa:",
          "content": "HTTP/1.1 200 OK\n{\n  \"Estado\" => \"Ok\",\n  \"Mensaje\" => \"Empleado dado de baja con exito\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Datos incorrectos o faltantes:",
          "content": "{\n  \"Estado\" => \"Error\",\n  \"Mensaje\" => \"Hay parametros faltantes\"\n}",
          "type": "json"
        },
        {
          "title": "No se encontro el id:",
          "content": "{\n  \"Estado\" => \"Error\",\n  \"Mensaje\" => \"No se pudo dar de baja el empleado\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./API/PHP/API/empleadoAPI.php",
    "groupTitle": "empleadoAPI"
  },
  {
    "type": "post",
    "url": "/empleados",
    "title": "CargarUno",
    "version": "0.1.0",
    "name": "CargarUno",
    "group": "empleadoAPI",
    "description": "<p>(Admin) Da de alta un nuevo empleado</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Email del empleado</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Password del empleado</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "\"dia\"",
              "\"tarde\"",
              "\"noche\""
            ],
            "optional": false,
            "field": "turno",
            "description": "<p>Turno del empleado</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "\"femenino\"",
              "\"masculino\""
            ],
            "optional": false,
            "field": "sexo",
            "description": "<p>Sexo del empleado</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "\"user\"",
              "\"admin\""
            ],
            "optional": false,
            "field": "perfil",
            "description": "<p>Perfil del empleado</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Como usarlo:",
        "content": "->post('[/]', \\vehiculoAPI::class . ':CargarUno')",
        "type": "json"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Alta exitosa:",
          "content": "HTTP/1.1 200 OK\n{\n  \"Estado\" => \"Ok\",\n  \"Mensaje\" => \"Empleado dado de alta con exito\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Datos incorrectos o faltantes:",
          "content": "{\n  \"Estado\" => \"Error\",\n  \"Mensaje\" => \"Hay parametros faltantes\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./API/PHP/API/empleadoAPI.php",
    "groupTitle": "empleadoAPI"
  },
  {
    "type": "put",
    "url": "/empleados",
    "title": "ModificarUno",
    "version": "0.1.0",
    "name": "ModificarUno",
    "group": "empleadoAPI",
    "description": "<p>(Admin) Modifica un empleado</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Id del empleado a modificar</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Email del empleado</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Password del empleado</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "\"dia\"",
              "\"tarde\"",
              "\"noche\""
            ],
            "optional": false,
            "field": "turno",
            "description": "<p>Turno del empleado</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "\"femenino\"",
              "\"masculino\""
            ],
            "optional": false,
            "field": "sexo",
            "description": "<p>Sexo del empleado</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "\"user\"",
              "\"admin\""
            ],
            "optional": false,
            "field": "perfil",
            "description": "<p>Perfil del empleado</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Como usarlo:",
        "content": "->put('[/]', \\empleadoAPI::class . ':ModificarUno')",
        "type": "json"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Modificacion exitosa:",
          "content": "HTTP/1.1 200 OK\n{\n  \"Estado\" => \"Ok\",\n  \"Mensaje\" => \"Empleado modificado con exito\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Datos incorrectos o faltantes:",
          "content": "{\n  \"Estado\" => \"Error\",\n  \"Mensaje\" => \"Hay parametros faltantes\"\n}",
          "type": "json"
        },
        {
          "title": "No se encontro el id:",
          "content": "{\n  \"Estado\" => \"Error\",\n  \"Mensaje\" => \"No se pudo modificar el empleado\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./API/PHP/API/empleadoAPI.php",
    "groupTitle": "empleadoAPI"
  },
  {
    "type": "get",
    "url": "/empleados",
    "title": "TraerTodos",
    "version": "0.1.0",
    "name": "TraerTodos",
    "group": "empleadoAPI",
    "description": "<p>Trae informacion de todos los empleados</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "CSV",
            "description": "<p>Opcional, se coloca este parametro si se quiere guardar el resultado de la busqueda en un archivo CSV. El valor que se pasa en este parametro sera el nombre del archivo guardado en API/PHP/Busquedas</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "PDF",
            "description": "<p>Opcional, se coloca este parametro si se quiere guardar el resultado de la busqueda en un archivo PDF. El valor que se pasa en este parametro sera el nombre del archivo guardado en API/PHP/Busquedas</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Como usarlo:",
        "content": "->get('[/]', \\empleadoAPI::class . ':TraerTodos')",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object[]",
            "optional": false,
            "field": "empleados",
            "description": "<p>Trae un array de empleados con todos los datos de los mismos</p>"
          }
        ]
      }
    },
    "filename": "./API/PHP/API/empleadoAPI.php",
    "groupTitle": "empleadoAPI"
  },
  {
    "type": "get",
    "url": "/empleados",
    "title": "TraerUno",
    "version": "0.1.0",
    "name": "TraerUno",
    "group": "empleadoAPI",
    "description": "<p>Trae informacion de un empleado, buscado por id</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Id del empleado a buscar</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Como usarlo:",
        "content": "->get('/{id}', \\empleadoAPI::class . ':traerUno')",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object[]",
            "optional": false,
            "field": "empleado",
            "description": "<p>Informacion del empleado encontrado</p>"
          }
        ]
      }
    },
    "filename": "./API/PHP/API/empleadoAPI.php",
    "groupTitle": "empleadoAPI"
  },
  {
    "type": "post",
    "url": "/empleados/busqueda",
    "title": "Busqueda",
    "version": "0.1.0",
    "name": "busqueda",
    "group": "empleadoAPI",
    "description": "<p>Trae los logins o la cantidad de operaciones de los empleados, desde siempre, en una fecha o rango de fechas determinados</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "\"logins\"",
              "\"operaciones\""
            ],
            "optional": false,
            "field": "filtro",
            "description": "<p>Datos que se necesitan saber</p>"
          },
          {
            "group": "Parameter",
            "type": "Date",
            "optional": true,
            "field": "fechaInicio",
            "description": "<p>Opcional, filtro de fecha, si no se especifica &quot;fechaFin&quot;, se filtra por esta fecha solamente. Formato 'yyyy/MM/dd'</p>"
          },
          {
            "group": "Parameter",
            "type": "Date",
            "optional": true,
            "field": "fechaFin",
            "description": "<p>Opcional, filtro de fecha, si se especifica, se filtra en el rango entre fechaInicio y este. Formato 'yyyy/MM/dd'</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Como usarlo:",
        "content": "->post('/busqueda[/]', \\empleadoAPI::class . ':busqueda')",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object[]",
            "optional": false,
            "field": "logins",
            "description": "<p>Un array con los mails de los usuarios, y la fecha en que se logearon</p>"
          },
          {
            "group": "Success 200",
            "type": "Object[]",
            "optional": false,
            "field": "operaciones",
            "description": "<p>Un array con los mails de los usuarios y la cantidad de operaciones que hicieron</p>"
          }
        ]
      }
    },
    "error": {
      "examples": [
        {
          "title": "Parametros erroneos:",
          "content": "{\n   \"Estado\" => \"Error\",\n   \"Mensaje\" => \"Error en los parametros\"\n}",
          "type": "json"
        },
        {
          "title": "Parametros faltantes:",
          "content": "{\n   \"Estado\" => \"Error\",\n   \"Mensaje\" => \"Hay parametros faltantes\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./API/PHP/API/empleadoAPI.php",
    "groupTitle": "empleadoAPI"
  },
  {
    "type": "post",
    "url": "/empleados/suspension",
    "title": "Suspension",
    "version": "0.1.0",
    "name": "suspension",
    "group": "empleadoAPI",
    "description": "<p>(Admin) Suspende a un empleado</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Id del empleado a suspender</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "\"alta\"",
              "\"cancelar\""
            ],
            "optional": false,
            "field": "motivo",
            "description": "<p>Motivo de suspension, 'alta' dara de alta la suspension, 'cancelar', cancela la suspension</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Como usarlo:",
        "content": "->post('/suspension[/]', \\empleadoAPI::class . ':suspension')",
        "type": "json"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Alta suspension exitosa:",
          "content": "HTTP/1.1 200 OK\n{\n  \"Estado\" => \"Ok\",\n  \"Mensaje\" => \"Empleado suspendido con exito\"\n}",
          "type": "json"
        },
        {
          "title": "Cancelacion de suspension exitosa:",
          "content": "HTTP/1.1 200 OK\n{\n  \"Estado\" => \"Ok\",\n  \"Mensaje\" => \"Suspension de empleado cancelada con exito\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Parametros erroneos:",
          "content": "{\n   \"Estado\" => \"Error\",\n   \"Mensaje\" => \"Error en los parametros\"\n}",
          "type": "json"
        },
        {
          "title": "Parametros faltantes:",
          "content": "{\n   \"Estado\" => \"Error\",\n   \"Mensaje\" => \"Hay parametros faltantes\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./API/PHP/API/empleadoAPI.php",
    "groupTitle": "empleadoAPI"
  },
  {
    "type": "post",
    "url": "/login",
    "title": "CargarUno",
    "version": "0.1.0",
    "name": "CargarUno",
    "group": "loginAPI",
    "description": "<p>Logea al usuario, creando un session token, y crea un nuevo registro de login en el sistema</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Email del usuario</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Password del usuario</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Como usarlo:",
        "content": "->post('[/]', \\loginAPI::class . ':CargarUno')",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "SessionToken",
            "description": "<p>SessionToken del usuario</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>Usuario no encontrado, datos incorrectos o faltantes</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "No se encontro al usuario:",
          "content": "{\n  \"Estado\" => \"Error\",\n  \"Mensaje\" => \"Datos incorrectos\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./API/PHP/API/loginAPI.php",
    "groupTitle": "loginAPI"
  },
  {
    "type": "delete",
    "url": "/vehiculos",
    "title": "BorrarUno",
    "version": "0.1.0",
    "name": "BorrarUno",
    "group": "vehiculoAPI",
    "description": "<p>(Admin) Da de baja un registro de vehiculos</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Id del vehiculo a dar de baja</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Como usarlo:",
        "content": "->delete('[/]', \\vehiculoAPI::class . ':BorrarUno')",
        "type": "json"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Baja exitosa:",
          "content": "HTTP/1.1 200 OK\n{\n  \"Estado\" => \"Ok\",\n  \"Mensaje\" => \"Vehiculo dado de baja con exito\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Datos incorrectos o faltantes:",
          "content": "{\n  \"Estado\" => \"Error\",\n  \"Mensaje\" => \"Hay parametros faltantes\"\n}",
          "type": "json"
        },
        {
          "title": "No se encontro el id:",
          "content": "{\n  \"Estado\" => \"Error\",\n  \"Mensaje\" => \"No se pudo dar de baja el vehiculo\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./API/PHP/API/vehiculoAPI.php",
    "groupTitle": "vehiculoAPI"
  },
  {
    "type": "post",
    "url": "/vehiculos",
    "title": "CargarUno",
    "version": "0.1.0",
    "name": "CargarUno",
    "group": "vehiculoAPI",
    "description": "<p>(Admin) Da de alta un nuevo vehiculo</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "patente",
            "description": "<p>Patente del vehiculo</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "color",
            "description": "<p>Color del vehiculo</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "marca",
            "description": "<p>Marca del vehiculo</p>"
          },
          {
            "group": "Parameter",
            "type": "File",
            "optional": false,
            "field": "foto",
            "description": "<p>Foto del vehiculo</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "emailEmpleadoIngreso",
            "description": "<p>Email del empleado que ingreso el vehiculo</p>"
          },
          {
            "group": "Parameter",
            "type": "Datetime",
            "optional": false,
            "field": "horaDeEntrada",
            "description": "<p>Fecha y hora que ingreso el vehiculo en formato &quot;yyyy-MM-dd hh:mm:ss&quot;</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "cochera",
            "description": "<p>Cochera en la que entrara el vehiculo</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "emailEmpleadoSalida",
            "description": "<p>Email del empleado que saco el vehiculo</p>"
          },
          {
            "group": "Parameter",
            "type": "Datetime",
            "optional": false,
            "field": "horaDeSalida",
            "description": "<p>Fecha y hora que salio el vehiculo en formato &quot;yyyy-MM-dd hh:mm:ss&quot;</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "importe",
            "description": "<p>Importe que se le cobro al vehiculo</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "tiempo_seg",
            "description": "<p>Tiempo en segundos que estuvo el vehiculo en el estacionamiento</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Como usarlo:",
        "content": "->post('[/]', \\empleadoAPI::class . ':CargarUno')",
        "type": "json"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Alta exitosa:",
          "content": "HTTP/1.1 200 OK\n{\n  \"Estado\" => \"Ok\",\n  \"Mensaje\" => \"Vehiculo dado de alta con exito\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Datos incorrectos o faltantes:",
          "content": "{\n  \"Estado\" => \"Error\",\n  \"Mensaje\" => \"Hay parametros faltantes\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./API/PHP/API/vehiculoAPI.php",
    "groupTitle": "vehiculoAPI"
  },
  {
    "type": "put",
    "url": "/vehiculos/modificar",
    "title": "ModificarUno",
    "version": "0.1.0",
    "name": "ModificarUno",
    "group": "vehiculoAPI",
    "description": "<p>(Admin) Modifica un vehiculo</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Id del vehiculo a modificar</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "patente",
            "description": "<p>Patente del vehiculo</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "color",
            "description": "<p>Color del vehiculo</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "marca",
            "description": "<p>Marca del vehiculo</p>"
          },
          {
            "group": "Parameter",
            "type": "File",
            "optional": false,
            "field": "foto",
            "description": "<p>Foto del vehiculo</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "emailEmpleadoIngreso",
            "description": "<p>Email del empleado que ingreso el vehiculo</p>"
          },
          {
            "group": "Parameter",
            "type": "Datetime",
            "optional": false,
            "field": "horaDeEntrada",
            "description": "<p>Fecha y hora que ingreso el vehiculo en formato &quot;yyyy-MM-dd hh:mm:ss&quot;</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "cochera",
            "description": "<p>Cochera en la que entrara el vehiculo</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "emailEmpleadoSalida",
            "description": "<p>Email del empleado que saco el vehiculo</p>"
          },
          {
            "group": "Parameter",
            "type": "Datetime",
            "optional": false,
            "field": "horaDeSalida",
            "description": "<p>Fecha y hora que salio el vehiculo en formato &quot;yyyy-MM-dd hh:mm:ss&quot;</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "importe",
            "description": "<p>Importe que se le cobro al vehiculo</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "tiempo_seg",
            "description": "<p>Tiempo en segundos que estuvo el vehiculo en el estacionamiento</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Como usarlo:",
        "content": "->post('/modificar[/]', \\vehiculoAPI::class . ':ModificarUno')",
        "type": "json"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Modificacion exitosa:",
          "content": "HTTP/1.1 200 OK\n{\n  \"Estado\" => \"Ok\",\n  \"Mensaje\" => \"Vehiculo modificado con exito\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Datos incorrectos o faltantes:",
          "content": "{\n  \"Estado\" => \"Error\",\n  \"Mensaje\" => \"Hay parametros faltantes\"\n}",
          "type": "json"
        },
        {
          "title": "No se encontro el id:",
          "content": "{\n  \"Estado\" => \"Error\",\n  \"Mensaje\" => \"No se pudo modificar el vehiculo\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./API/PHP/API/vehiculoAPI.php",
    "groupTitle": "vehiculoAPI"
  },
  {
    "type": "get",
    "url": "/vehiculos",
    "title": "TraerTodos",
    "version": "0.1.0",
    "name": "TraerTodos",
    "group": "vehiculoAPI",
    "description": "<p>Trae informacion de todos los vehiculos</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Date",
            "optional": true,
            "field": "fechaInicio",
            "description": "<p>Opcional, filtro de fecha, si no se especifica &quot;fechaFin&quot;, se filtra por esta fecha solamente. Formato 'yyyy/MM/dd'</p>"
          },
          {
            "group": "Parameter",
            "type": "Date",
            "optional": true,
            "field": "fechaFin",
            "description": "<p>Opcional, filtro de fecha, si se especifica, se filtra en el rango entre fechaInicio y este. Formato 'yyyy/MM/dd'</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "CSV",
            "description": "<p>Opcional, se coloca este parametro si se quiere guardar el resultado de la busqueda en un archivo CSV. El valor que se pasa en este parametro sera el nombre del archivo guardado en API/PHP/Busquedas</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "PDF",
            "description": "<p>Opcional, se coloca este parametro si se quiere guardar el resultado de la busqueda en un archivo PDF. El valor que se pasa en este parametro sera el nombre del archivo guardado en API/PHP/Busquedas</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Como usarlo:",
        "content": "->get('[/]', \\vehiculoAPI::class . ':TraerTodos')",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object[]",
            "optional": false,
            "field": "vehiculos",
            "description": "<p>Trae un array de vehiculos con todos los datos de los mismos</p>"
          }
        ]
      }
    },
    "filename": "./API/PHP/API/vehiculoAPI.php",
    "groupTitle": "vehiculoAPI"
  },
  {
    "type": "get",
    "url": "/vehiculos",
    "title": "TraerUno",
    "version": "0.1.0",
    "name": "TraerUno",
    "group": "vehiculoAPI",
    "description": "<p>Trae informacion de un vehiculo, buscado por id</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Id del empleado a buscar</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Como usarlo:",
        "content": "->get('/{id}', \\vehiculoAPI::class . ':traerUno')",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object[]",
            "optional": false,
            "field": "vehiculo",
            "description": "<p>Informacion del vehiculo encontrado</p>"
          }
        ]
      }
    },
    "filename": "./API/PHP/API/vehiculoAPI.php",
    "groupTitle": "vehiculoAPI"
  },
  {
    "type": "post",
    "url": "/vehiculos/entrada",
    "title": "entrada",
    "version": "0.1.0",
    "name": "entrada",
    "group": "vehiculoAPI",
    "description": "<p>(User/Admin) Da de alta la entrada de un nuevo vehiculo</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "patente",
            "description": "<p>Patente del vehiculo</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "color",
            "description": "<p>Color del vehiculo</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "marca",
            "description": "<p>Marca del vehiculo</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "cochera",
            "description": "<p>Cochera en la que entrara el vehiculo</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "\"true\"",
              "\"false\""
            ],
            "optional": false,
            "field": "discapacitado",
            "description": "<p>Valor que sirve para indicar si el auto ingresante contiene personas discapacitadas</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Como usarlo:",
        "content": "->post('/entrada[/]', \\vehiculoAPI::class . ':entrada')",
        "type": "json"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Entrada de vehiculo exitosa:",
          "content": "HTTP/1.1 200 OK\n{\n  \"Estado\" => \"Ok\",\n  \"Mensaje\" => \"Entrada de vehiculo dada de alta con exito\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Vehiculo ya estacionado:",
          "content": "{\n  \"Estado\" => \"Error\",\n  \"Mensaje\" => \"El vehiculo ya esta estacionado\"\n}",
          "type": "json"
        },
        {
          "title": "Datos incorrectos o faltantes:",
          "content": "{\n  \"Estado\" => \"Error\",\n  \"Mensaje\" => \"Hay parametros faltantes\"\n}",
          "type": "json"
        },
        {
          "title": "Datos en blanco:",
          "content": "{\n  \"Estado\" => \"Error\",\n  \"Mensaje\" => \"Los parametros no pueden estar en blanco\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./API/PHP/API/vehiculoAPI.php",
    "groupTitle": "vehiculoAPI"
  },
  {
    "type": "post",
    "url": "/vehiculos/salida",
    "title": "salida",
    "version": "0.1.0",
    "name": "salida",
    "group": "vehiculoAPI",
    "description": "<p>(User/Admin) Da de alta la salida de un vehiculo y devuelve los datos del mismo</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "patente",
            "description": "<p>Patente del vehiculo</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Como usarlo:",
        "content": "->post('/salida[/]', \\vehiculoAPI::class . ':salida')",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object[]",
            "optional": false,
            "field": "datos",
            "description": "<p>Trae un json con el estado de la operacion, un mensaje que informa la misma, y un objeto Vehiculo con los datos del mismo</p>"
          }
        ]
      }
    },
    "error": {
      "examples": [
        {
          "title": "Vehiculo que no esta estacionado:",
          "content": "{\n  \"Estado\" => \"Error\",\n  \"Mensaje\" => \"El vehiculo no esta estacionado\"\n}",
          "type": "json"
        },
        {
          "title": "Datos incorrectos o faltantes:",
          "content": "{\n  \"Estado\" => \"Error\",\n  \"Mensaje\" => \"Hay parametros faltantes\"\n}",
          "type": "json"
        },
        {
          "title": "Datos en blanco:",
          "content": "{\n  \"Estado\" => \"Error\",\n  \"Mensaje\" => \"Los parametros no pueden estar en blanco\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./API/PHP/API/vehiculoAPI.php",
    "groupTitle": "vehiculoAPI"
  }
] });
