from mrjob.job import MRJob

class MRFriendsByAge(MRJob):

	def mapper(self, _, line):
		(ID, name, age, num_of_friends) = line.split(',')
		yield age, float(num_of_friends)

	def reducer(self, age, num_of_friends):
		total = 0
		count = 0
		for x in num_of_friends:
			total += x
			count += 1

		yield age, total/count

if __name__ == '__main__':
	MRFriendsByAge.run()
