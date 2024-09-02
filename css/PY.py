def binary_search(arr, x):
    low = 0
    high = len(arr) - 1
    mid = 0

    while low <= high:
        mid = (high + low) // 2

        if arr[mid] < x:
            low = mid + 1
        elif arr[mid] > x:
            high = mid - 1
        else:
            return mid

    return -1

# Ejemplo de uso
arr = [2, 3, 4, 10, 40]
x = 20

result = binary_search(arr, x)

if result != -1:
    print(f"El elemento {x} está en el índice {result}")
else:
    print("El elemento no está en la lista")
