# pick any node. if it is not visited, visit it and then recurse on its neighbors
# do this till all nodes are visited

graph = {
	'A': ['B', 'C'],
	'B': ['D', 'E'],
	'C': ['F'],
	'D': [],
	'E': ['F'],
	'F': []
}

visited = set()

def depthFirstSearch(graph, visited, node):
	if node not in visited:
		print(node, end=" ")
		visited.add(node)
		for neighbor in graph[node]:
			depthFirstSearch(graph, visited, neighbor)

depthFirstSearch(graph, visited, 'A')
