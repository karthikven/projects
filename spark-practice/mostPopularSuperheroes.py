# get count of friends for each superhero from Marvel-graph
# for the super hero with the highest count, get his name from Marvel-names, an ancillary file

from mrjob.job import MRJob
from mrjob.step import MRStep

class mostPopularSuperhero(MRJob):

	def configure_args(self):
		super(mostPopularSuperhero, self).configure_args()
		self.add_file_arg('--names', help='Path to Marvel-names')

	def steps(self):
		return [

		MRStep(mapper = self.mapper_count_friends_per_line, reducer = self.reducer_combine_friends),
		MRStep(mapper = self.mapper_prep_for_sort, mapper_init = self.load_name_dictionary, reducer = self.reducer_find_max_friends)
		
		]

	def mapper_count_friends_per_line(self, key, line):
		fields = line.split()
		heroID = fields[0]
		numFriends = len(fields) - 1
		yield int(heroID), int(numFriends)

	def reducer_combine_friends(self, heroID, numFriends):
		yield heroID, sum(numFriends)

	def mapper_prep_for_sort(self, heroID, numFriends):
		heroName = self.heroNames[heroID]
		yield None, (numFriends, heroName)

	def reducer_find_max_friends(self, key, value):
		yield max(value)

	def load_name_dictionary(self):
		self.heroNames = {}

		with open("Marvel-names.txt") as f:
			for line in f:
				fields = line.split('"')
				heroID = int(fields[0])
				self.heroNames[heroID] = fields[1]

if __name__ == '__main__':
	mostPopularSuperhero.run()
