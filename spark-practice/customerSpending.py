from mrjob.job import MRJob
from mrjob.step import MRStep

class customerSpending(MRJob):

	def steps(self):
		return [
		MRStep(mapper = self.mapper, reducer = self.reducer_sum_order),
		MRStep(reducer = self.reducer_output_orders)
		]

	def mapper(self, key, line):
		(customer, item, order_amount) = line.split(',')
		yield customer, float(order_amount)

	def reducer_sum_order(self, customer, order_amount):
		yield None, (sum(order_amount), customer)

	def reducer_output_orders (self, _, customers):
		for tot, customer in sorted(customers, reverse = False):
			yield (customer, tot)

if __name__ == '__main__':
	customerSpending.run()
