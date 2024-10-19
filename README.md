# Trabajo Práctico Especial WEB-2 Parte N°1

Alumnos: Martiniano Gutierrez , Matias Bruno

Concesionaria M & M

Se dedica a la compra y venta de autos, que regista sus vehiculos en stock en una base de datos donde se le vinculan la marca del vehiculo con las marcas registradas.

Cada marca tiene como atributo un nombre y una imagen reprensentiva.
Por otro lado los vehiculos se componen de un modelo, descripcion , imagen y marca. Esta ultima es la clave foranea que se relaciona con la clave primaria id_marca de la tabla marcas.

---

# Trabajo Práctico Especial WEB-2 Parte N°2

- En el pagina web se puede acceder con dos roles diferentes. Uno como invitado(sin logearse) y como administrador(logeado).
- El rol de invitado puede navegar por todo el sitio pero no tiena acceso ni permisos para agregar, modificar o borrar las marcas(categorias) y vehiculos(items).
- El rol de administrador una vez logeado tiene los permisos necesarios para poder realizar cualquier cambio, alta o modificaion en las categorias e items mediante los formularios especificos.

## Usuarios Registrados

    *usuario: webadmin,
    *passwoard: admin,

## Despliegue

- Para iniciar un despliegue con XAMPP se debe clonar o descargar el repositorio en la carpeta C:/xampp/htdocs/TPE-WEB2 , luego activar el servicio de apache y dirigirse al navegador colocando la URL= localhost/TPE-WEB2.
- Por otro lado se debe importar la Base de Datos para que se obtenga la informacion de las categorias y los items. Previamente activando desde XAMPP el servicio de MySQL.


