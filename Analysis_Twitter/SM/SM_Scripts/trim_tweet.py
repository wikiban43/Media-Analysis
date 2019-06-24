import json
#delete_list = ["id","source","in_reply_to_status_id","in_reply_to_user_id","in_reply_to_screen_name","coordinates","place","quoted_status_id","is_quote_status","extended_entities","matching_rules","filter_level","possibly_sensitive","retweeted","favorited"]

e_list = ["created_at","id_str","full_text","in_reply_to_status_id_str","in_reply_to_user_id_str","in_reply_to_screen_name","quote_count","reply_count","retweet_count","favorite_count"]


def trim(tw):
	#delete_list = ["id","source","in_reply_to_status_id","in_reply_to_user_id","in_reply_to_screen_name","coordinates","place","quoted_status_id","is_quote_status","extended_entities","matching_rules","filter_level","possibly_sensitive","retweeted","favorited"]
	dw = {}
	for x in e_list:
		try:
			dw[x] = tw[x]
		except:
			pass
	dw["hashtags"] = [d["text"] for d in tw["entities"]["hashtags"]]
	dw["urls"] = [d["expanded_url"] for d in tw["entities"]["urls"]]
	dw["user_id"] = tw["user"]["id_str"]
	tl = [dw]
	
	try:
		tl[0]["retweet_of"] = tw["retweeted_status"]["id_str"]
		tl.extend(trim(tw["retweeted_status"]))
	except:
		pass
	try:
		tl[0]["quote_of"] = tw["quoted_status"]["id_str"]
		tl.extend(trim(tw["quoted_status"]))
	except:
		pass
	
	return tl


#def main():
'''
if __name__ == '__main__':
	with open("60940448tweets.json",'r') as uf:
		tw = json.load(uf)
	with open("check.json",'w') as f:
		all_tweets = []
		for tweet in tw:
			all_tweets.extend(trim(tweet))
		json.dump(all_tweets,f)
		
'''
