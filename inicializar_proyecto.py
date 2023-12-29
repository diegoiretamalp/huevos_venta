import os

def crear_carpetas():
    # Definir las rutas de las carpetas
    carpetas = [
        'writable',
        'writable/session',
        'writable/debugbar',
        'writable/cache'
    ]

    try:
        # Crear las carpetas si no existen
        for carpeta in carpetas:
            if not os.path.exists(carpeta):
                os.makedirs(carpeta)

                # Asignar permisos adecuados (por ejemplo, 0o755)
                os.chmod(carpeta, 0o755)

        print("Carpetas creadas con éxito.")
    except Exception as e:
        print(f"Error al crear las carpetas: {e}")

if __name__ == "__main__":
    crear_carpetas()
