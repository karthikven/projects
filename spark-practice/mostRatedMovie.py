# find the most rated movie

from mrjob.job import MRJob
from mrjob.step import MRStep

class mostRatedMovie (MRJob):

	def steps(self):
		return [
			MRStep(mapper = self.mapper, reducer = self.reducer_1),
			MRStep(reducer = self.reducer_2)
		]

	def mapper (self, key, line):
		(user, movie, rating, timestamp) = line.split('\t')
		yield movie, 1

	def reducer_1 (self, movie, rating):
		yield None, (sum(rating), movie)

	def reducer_2 (self, key, values):
		yield max(values)
		
if __name__ == '__main__':
	mostRatedMovie.run()

