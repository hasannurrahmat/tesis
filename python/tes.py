# import StemmerFactory class
from Sastrawi.Stemmer.StemmerFactory import StemmerFactory
# import StopWordRemoverFactory class
from Sastrawi.StopWordRemover.StopWordRemoverFactory import StopWordRemoverFactory
 
import re, csv

factory = StopWordRemoverFactory()
stopword = factory.create_stop_word_remover()

factory = StemmerFactory()
stemmer = factory.create_stemmer()
 
num_lines = sum(1 for line in open('c:/xampp/htdocs/efasonline/python/data_training.csv'))
file = [[0 for x in range(2)] for y in range(num_lines)]

#save file
savemyFile = open('c:/xampp/htdocs/efasonline/python/preprocessfile.csv', 'w', newline='')
# with savemyFile:
writer = csv.writer(savemyFile, delimiter=',', lineterminator='\r\n', quoting=csv.QUOTE_ALL)

with open('c:/xampp/htdocs/efasonline/python/data_training.csv', newline='') as myFile:  
    reader = csv.reader(myFile, delimiter=';', quoting=csv.QUOTE_NONE)
    i=0
    for row in reader:
        #remove number
        kalimat = re.sub(r'\d+', '', row[2])
        
        #stemming
        katadasar = stemmer.stem(kalimat)

        #stopword removal
        kata = stopword.remove(katadasar)
        print(kata)

        #add to array
        file[i][0] = kata
        file[i][1] = row[0]

        #write file
        writer.writerow(file[i])
        i = i + 1