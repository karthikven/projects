graph = {
  'A': ['B', 'C'],
  'B': ['D', 'E'],
  'C': ['F'],
  'D': [],
  'E': ['F'],
  'F': []
}

visited = []
queue = []

def bfs (visited, graph, node):
  visited.append(node)
  queue.append(node)

  while (queue):
    s = queue.pop(0)
    print(s, end = " ")

    for neighbor in graph[s]:
      if neighbor not in visited:
        visited.append(neighbor)
        queue.append(neighbor)

bfs(visited,graph,'A')

