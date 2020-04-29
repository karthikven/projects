from mrjob.job import MRJob
from mrjob.step import MRStep

class customerSpendingSorted (MRJob):

	def steps(self):
		return [

			MRStep (mapper = self.mapper_customer_spend, reducer = self.reducer_customer_amount),
			MRStep (mapper = self.mapper_amount_as_key, reducer = self.reducer_customer_spend_sorted)
		]

	def mapper_customer_spend (self, key, line):
		(customer, item, order_amount) = line.split(',')
		yield customer, float(order_amount)

	def reducer_customer_amount (self, customer, order_amount):
		yield customer, sum(order_amount)

	def mapper_amount_as_key (self, customer, order_amount):
		yield int(order_amount), customer

	def reducer_customer_spend_sorted (self, order_amount, customers):
		for customer in customers:
			yield customer, order_amount

if __name__ == '__main__':
	customerSpendingSorted.run()


