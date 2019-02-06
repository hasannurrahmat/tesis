# import StemmerFactory class
from Sastrawi.Stemmer.StemmerFactory import StemmerFactory
# import StopWordRemoverFactory class
from Sastrawi.StopWordRemover.StopWordRemoverFactory import StopWordRemoverFactory
 
import re, csv

factory = StopWordRemoverFactory()
stopword = factory.create_stop_word_remover()

factory = StemmerFactory()
stemmer = factory.create_stemmer()
 
num_lines = sum(1 for line in open('c:/xampp/htdocs/efasonline/python/testing/testing_politik.csv'))
file = [[0 for x in range(5)] for y in range(num_lines)]

#save file
savemyFile = open('c:/xampp/htdocs/efasonline/python/testing/testing_preprocess_politik.csv', 'w', newline='')
# with savemyFile:
writer = csv.writer(savemyFile, delimiter=';', lineterminator='\r\n', quoting=csv.QUOTE_ALL)

with open('c:/xampp/htdocs/efasonline/python/testing/testing_politik.csv', newline='') as myFile:  
    reader = csv.reader(myFile, delimiter=';', quoting=csv.QUOTE_ALL)
    i=0
    for row in reader:
        #remove number
        kalimat = re.sub(r'\d+', '', row[3])
        
        #stemming
        katadasar = stemmer.stem(kalimat)

        #stopword removal
        kata = stopword.remove(katadasar)
        # print(kata)

        #add to array
        file[i][0] = row[0]
        file[i][1] = row[1]
        file[i][2] = row[2]
        file[i][3] = kata
        file[i][4] = row[4]

        #write file
        writer.writerow(file[i])
        i = i + 1

myFile.close()
savemyFile.close()