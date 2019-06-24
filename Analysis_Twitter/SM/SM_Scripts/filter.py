import json
import re
import sys

p = re.compile('aadhar')

def is_keyword_demon(x):	
	text = (re.sub('[^A-Za-z]', ' ', x["full_text"])).lower()
	if ('demonetization' in text) or ('demonetisation' in text):
		return True
	for i in x["hash_tags"]:
		if 'notebandi' == i.lower():
			return True
		if 'cashcleanup' == i.lower():
			return True
		if 'cashlesseconomy' == i.lower():
			return True
		if 'gocashless' in i.lower():
			return True
	return False

def is_keyword_aad(x):	
	text = (re.sub('[^A-Za-z]', ' ', x["full_text"])).lower()
	m = p.search(text)
	if m == None:
		return False
	else:
		return True

'''
def filter_user(x):
	with open('','r') as fp:
'''
def is_keyword(x):
	is_keyword_aad(x)


if __name__ == '__main__':
	list_file = open(sys.argv[1],'r')
	tweet_file = open(sys.argv[2],'w')
	for file_name in list_file:
		#print file_name
		if file_name!='':
			with open(file_name[:-1],'r') as fp:
				tweets = json.load(fp)
				for tweet in tweets:
					if is_keyword(tweet):
						json.dump(tweet,tweet_file)
						tweet_file.write('\n')
	list_file.close()
	tweet_file.close()