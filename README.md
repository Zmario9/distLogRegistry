Proyecto creado por:
- José Correa - 27.666.75
- Jonathan Campos - 30.417.006

Esta aplicación tiene como propósito la simple demostración de un mini-proyecto
donde se busca permitir simular el ciclo de uso una web con registro, inicio de sesión
y manejo de la información de un usuario, lo que nos permitirá en el futuro una aplicación
realista con información de usuario protegida, en este caso sin el uso de JSON o alguna
base de datos, sino simulado en arreglos de PHP por sesión.

CICLO:

1 - Programado en .htaccess para que la app te muestre primero el servicio de login
2 - Si no se ha creado un usuario, está la opción que te redirigirá al formulario de
    registro de usuario.
3 - Luego de haber verificado contraseñas, nickname de usuario y correo, se retornará
    al formulario de login con un mensaje de éxito por el registro.
4 - Al iniciar con tus credenciales correctamente (uso del correo y contraseña), deberías 
    ser enviado al dashboard del usuario donde deberías ver un saludo de recibimiento con tu nombre de usuario.
5 - Si se cierra la pestaña e intenta ingresar nuevamente, te reedirigirá a tu dashboard 
    ya que la sesión se mantuvo, esto termina cuando se haya cerrado sesión

CODIGO: 70% PHP por uso de backend y parte del front, 30% estilos de html y css