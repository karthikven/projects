# Traverse a graph 
# Pick a node. Visit its adjacent, unvisited vertices, mark them as visited and add them to the Queue
# If there are no adjacent vertices left, remove first node from the queue and repeat previous step
# continue doing this till the Queue is empty

# define a graph
graph = {
	'A': ['B', 'C'],
	'B': ['D', 'E'],
	'C': ['F'],
	'D': [],
	'E': ['F'],
	'F': []
}

# create a Queue and a list to keep track of Visited vertices
queue = []
visited = []

# define a function to implement BFS traversal
def bfs_traversal(visited, graph, node):
	# visit the source node and add it to the queue
	visited.append(node)
	queue.append(node)

	# explore unvisited neighbors of nodes in Queue till it becomes empty
	while queue:
		s = queue.pop(0)
		print(s, end = " ")

		for neighbor in graph[s]:
			if neighbor not in visited:
				visited.append(neighbor)
				queue.append(neighbor)

bfs_traversal(visited, graph, 'A')

