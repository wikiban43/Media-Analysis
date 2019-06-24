import json
from vaderSentiment.vaderSentiment import SentimentIntensityAnalyzer

if __name__ == '__main__':
        analyser = SentimentIntensityAnalyzer()

        list_file = open(sys.argv[1],'r')
        for line in list_file:
                if line!='':

                        file = open(line[:-1],'r')
                        new_file = open('new'+line[:-1],'w')
                        for line in file:
                                if line!='':
                                        k = json.loads(line)
                                        if k["id_str"] in prev_tweets:
                                        	continue
                                        k = {**k,**analyser.polarity_scores(k["full_text"])}
                                        json.load(k,new_file)
                                        new_file.write('\n')
                        file.close()
                        new_file.close()
