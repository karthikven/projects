# dfs but without recursion, implemented using a stack
# pick a node. visit it and add its adjacent neighbors to stack
# if there are no neighbors, pop the stack and repeat previous step
# continue till stack is empty

graph = {
	'A': ['B','C'],
	'B': ['D', 'E'],
	'C': ['F'],
	'D': [],
	'E': ['F'],
	'F': []
}

visited = []
stack = []

def dfs_with_stack(graph, visited, node):
	visited.append(node)
	stack.append(node)

	while stack:
		s = stack.pop()
		print(s, end = " ")
		for neighbor in graph[s]:
			if neighbor not in visited:
				visited.append(neighbor)
				stack.append(neighbor)

dfs_with_stack(graph, visited, 'A')
