hairs = ['brown', 'blond', 'red']
eyes = ['brown', 'blue', 'green']
weights = [1,2,3,4]

the_count = [1, 2, 3, 4, 5]
fruits = ['apples', 'oranges', 'pears', 'apricots']
change = [1, 'pennies', 2, 'dimes', 3, 'quarters']

# print elements in list

for num in the_count:
	print(f"element: {num}")

for fruit in fruits:
	print(f"fruit: {fruit}")

for i in change:
	print(f"element: {i}")

elements = []

for i in range(0,6):
	elements.append(i)

for i in elements:
	print(f"{i}", end = ' ')
