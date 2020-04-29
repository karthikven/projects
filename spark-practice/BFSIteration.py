from mrjob.job import MRJob
from mrjob.protocol import RawValueProtocol

#create a class to represent each node in the graph

class Node:
	def __init__(self):
		self.characterID = ''
		self.connections = []
		self.distance = 9999
		self.color = 'WHITE'

	# Format is ID|EDGES|DISTANCE|COLOR

	# converts a line from ProcessMarvel output to a Node
	def fromLine(self, line):
		fields = line.split('|')
		if (len(fields) == 4):
			self.characterID = fields[0]
			self.connections = fields[1].split(',')
			self.distance = int(fields[2])
			self.color = fields[3]

	# converts a node's values to a line of output
	def getLine(self):
		connections = ','.join(self.connections)
		return '|'.join( (self.characterID, connections,str(self.distance), self.color) )

class MRBFSIteration(MRJob):

	INPUT_PROTOCOL = RawValueProtocol
	OUTPUT_PROTOCOL = RawValueProtocol

	# above is used so that the input/output is untouched and in the same format as we started with (no additional processing needed)

	# below function is used to pass along the target node to every processor in the cluster
	def configure_args(self):
		super(MRBFSIteration, self).configure_args()
		self.add_passthru_arg('--target', help = "ID of Character we are searching for")

	def mapper(self, _, line):
		node = Node()
		node.fromLine(line)
		#if this node needs to be expanded...
		# if the node's color is gray, explore its connections
		if (node.color == "GRAY"):
			for connection in node.connections:
				vnode = Node()
				vnode.characterID = connection
				vnode.distance = int(node.distance)+1
				vnode.color = 'GRAY'
				if (self.args.target == connection):
					counterName = ("Target ID" + connection + "was hit with distance " + str(vnode.distance))
					self.increment_counter('Degrees of Separation', counterName, 1)
				yield connection, vnode.getLine()

				node.color = 'BLACK'

		yield node.characterID, node.getLine()

	def reducer(self, key, values):
		edges = []
		distance = 9999
		color = 'WHITE'

		for value in values:
			node = Node()
			node.fromLine(value)

			if(len(node.connections) > 0):
				edges.extend(node.connections)

			if (node.distance < distance):
				distance = node.distance

			if (node.color == 'BLACK'):
				color = 'BLACK'

			if (node.color == 'GRAY' and color == 'WHITE'):
				color = 'GRAY'

			node = Node()
			node.characterID = key
			node.distance = distance
			node.color = color

			node.connections = edges[:500]

			yield key, node.getLine()

if __name__ == '__main__':
	MRBFSIteration.run()
