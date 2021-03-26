# ----------------------------------------------------------------
# Metodo para el truncado de digitos de algun numero flotante
#  se requiere la importacion
#     from math import trunc
# ----------------------------------------------------------------

def truncate(number, digits) -> float:
    stepper = 10.0 ** digits
    return trunc(stepper * number) / stepper


# ----------------------------------------------------------------
# Metodo para la convercion de de bytes a unidades superiores
# ----------------------------------------------------------------
def convert_bytes(quantity: float, convertion: str = 'B') -> float:
    divisor = 1024
    switcher = {
        'KB': lambda numb: numb / divisor,
        'MB': lambda numb: convert_bytes(numb, 'KB') / divisor,
        'GB': lambda numb: convert_bytes(numb, 'MB') / divisor
    }
    return switcher.get(convertion, lambda: "Invalid convertion")(quantity)


# -------------------------------------------------------
# Metodo para obtener el nombre base de un archivo
# se requiere la importacion
#    from os import path
# -------------------------------------------------------
def file_name(file_path: str) -> str:
    return path.basename(file_path)
