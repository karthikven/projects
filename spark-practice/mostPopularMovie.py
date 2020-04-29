# most popular movie or the most rated movie

from mrjob.job import MRJob
from mrjob.step import MRStep

class MostPopularMovie(MRJob):
	def steps(self):
		return [
		MRStep(mapper = self.mapper_get_rating, reducer = self.reducer_count_rating),
		MRStep(reducer = self.reducer_find_max)
		]

	def mapper_get_rating(self, key, line):
		(userID, movieID, rating, timestamp) = line.split('\t')
		yield movieID,1

	def reducer_count_rating(self, key, values):
		yield None,(sum(values), key)

	def reducer_find_max(self, key, values):
		yield max(values)

if __name__ == '__main__':
	MostPopularMovie.run()
