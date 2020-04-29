# examples where function arguments are different from arguments in the script (formal vs actual parameters)

def cheese_and_crackers(cheese_count, boxes_of_crackers):
	print(f"You have {cheese_count} cheeses!")
	print(f"You have {boxes_of_crackers} boxes of crackers!")

print("We can give the function numbers directly:")
cheese_and_crackers(20, 30)

print("OR, we can use variables from our script:")
amount_of_cheese = 10
amount_of_crackers = 50

cheese_and_crackers(amount_of_cheese, amount_of_crackers)

print("OR: ")
cheese_and_crackers(10+20, 5+6)

print("OR another way: ")
cheese_and_crackers(amount_of_cheese + 100, amount_of_crackers + 1000)
