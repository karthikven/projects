# Functions
# names for pieces of code
# take arguments same way scripts take argv
# make mini-scripts

# function with two arguments

def print_two(*args):
	arg1, arg2 = args
	print(f"arg1: {arg1}, arg2: {arg2}")

# another way:

def print_two_again(arg1, arg2):
	print(f"arg1: {arg1}, arg2: {arg2}")

# with one arg

def print_one(arg1):
	print(f"arg1: {arg1}")

def print_none():
	print("I got nuthin'.")

print_two("Kweli", "Mos")
print_two_again("Kweli", "Mos")
print_one("BLACK STAR")
print_none()
