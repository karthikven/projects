# functions that return a value

def add(a,b):
	print(f"ADDING {a} and {b}")
	return (a+b)

def subtract(a, b):
	print(f"SUBTRACTING {a} - {b}")
	return (a-b)

def multiply(a, b):
	print(f"MULTIPLYING {a} * {b}")
	return (a*b)

def divide(a, b):
	print(f"DIVIDING {a}/{b}")
	return (a/b)

print("Mathematics...")

age = add(30,5)
height = subtract(78,4)
weight = multiply(90, 2)
iq = divide(100, 2)

print(f"Age: {age}, Height: {height}, Weight: {weight}, IQ: {iq}")



