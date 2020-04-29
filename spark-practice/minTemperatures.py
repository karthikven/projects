# find minimum temperatures for each weather station

from mrjob.job import MRJob

class minTemperatures (MRJob):

	def mapper (self, key, line):
		(weather_station, date, prop, data, dummy1, dummy2, dummy3, dummy4) = line.split(',')
		if (prop == 'TMIN'):
			temp = ((float(data) / 10.00) * 1.8) + 32.0
			yield weather_station, temp

	def reducer (self, weather_station, temp):
		yield weather_station, min(temp)

if __name__ == '__main__':
	minTemperatures.run()
