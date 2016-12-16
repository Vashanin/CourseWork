import re											# для роботи з регулярними виразами
import os											# для роботи з папками та системою

def change_words_in(from_this, to_this, path):
	with open(path, "r") as html_code:
		content = html_code.read()								# відкриваєш відповідний файл та записуєш його вміст в змінну content
		
	result = re.sub(r'%s' % str(from_this), to_this, content)	# за допомогою регулярних виразів, змінюєш кожне входження

	with open(path, "w") as html_code:							# записуєш змінений контент назад
		html_code.write(result)

# just for testing

path = "Z:\\home\\localhost\\www\\CourseWork\\"

mode = 1
file_type = 'php'
from_ = 'lab7'
to_ = 'CourseWork'

if (mode == 0):
	os.chdir(path)
	for i in os.listdir(path="."):	
		print(os.getcwd() + "\\" + i)								# перебір кожного файлу присутнього в директорії та його зміна
		change_words_in(from_, to_, os.getcwd() + "\\" + i)

if (mode == 1):
	print(path)
	change_words_in(from_, to_, path)

if (mode == 2):
	os.chdir(path)
	for i in os.listdir(path="."):	
		name = i.split('.')
		if(name[len(name) - 1] == file_type):
			print(os.getcwd() + "\\" + i)
			change_words_in(from_, to_, os.getcwd() + "\\" + i)
		else:
			print("Not match: " + os.getcwd() + "\\" + i)