import sys
import trim_tweet
import json
if sys.version_info[0] < 3:
    import got
else:
    import got3 as got

def main():

	def check(tweet,np): # function to check if the url tweet is not made by the newspaper handle itself.
		if np == 'HINDU':
			if tweet.username == 'the_hindu':
				return False
		if np == 'INDIANEXPRESS':
			if tweet.username == 'IndianExpress':
				return False
		if np == 'NEWINDIANEXPRESS':
			if tweet.username == 'NewIndianXpress':
				return False
		if np == 'TIMESOFINDIA':
			if tweet.username == 'timesofindia':
				return False
			elif 'TOI' in tweet.username:
				return False
		if np == 'HINDUSTANTIMES':
			if tweet.username == 'htTweets':
				return False
		if np == 'DECCANHERALD':
			if tweet.username == 'DeccanHerald':
				return False
		if np == 'TELEGRAPH':
			if tweet.username == 'ttindia':
				return False
		return True

	# Example 1 - Get tweets by username
	'''
	tweetCriteria = got.manager.TweetCriteria().setUsername('barackobama').setMaxTweets(1)
	tweet = got.manager.TweetManager.getTweets(tweetCriteria)[0]

	printTweet("### Example 1 - Get tweets by username [barackobama]", tweet)
	'''
	'''
	loop on url dict:
		get tweets on the url
		make 

	'''
	# Example 2 - Get tweets by query search
	'''
	tweetCriteria = got.manager.TweetCriteria().setQuerySearch('url:aap-announces-dalit-manifesto-for-punjab-elections-4395123')
	tweets = got.manager.TweetManager.getTweets(tweetCriteria)
	for tweet in tweets:
		print tweet.date
	'''

	#printTweet("### Example 2 - Get tweets by query search [europe refugees]", tweet)

	# Example 3 - Get tweets by username and bound dates
	'''
	tweetCriteria = got.manager.TweetCriteria().setUsername("barackobama").setSince("2015-09-10").setUntil("2015-09-12").setMaxTweets(1)
	tweet = got.manager.TweetManager.getTweets(tweetCriteria)[0]

	printTweet("### Example 3 - Get tweets by username and bound dates [barackobama, '2015-09-10', '2015-09-12']", tweet)
	'''
	i=0
	file = open(sys.argv[1],'r')
	outf = open(sys.argv[2],'w')
	for line in file:
		if line!='':
			i+=1
			if i%100 == 0:
				print i
			data = line[:-1].split(';')
			print data[0]
			
			tweetCriteria = got.manager.TweetCriteria().setQuerySearch('url:'+data[0])
			tweets = got.manager.TweetManager.getTweets(tweetCriteria)
			for tweet in tweets:
				print tweet.id
				if check(tweet,data[1]):
					d = {}
					d['id'] = str(tweet.id)
					d['user_id'] = str(tweet.user_id)
					d['full_text'] = tweet.text
					d['retweet_count'] = tweet.retweets
					d['favorite_count'] = tweet.favorites
					d['screen_name'] = tweet.username
					d['article_url'] = data[0]
					d['created_at'] = tweet.date
					json.dump(d,outf)
					outf.write('\n')


if __name__ == '__main__':
	main()
