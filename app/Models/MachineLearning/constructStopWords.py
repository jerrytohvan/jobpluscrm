import sys,re

dictionary = []

def compare_to_list(filename):
    with open(filename, 'r') as f:
        store = [l.strip() for l in f]
        for word in store:
            if word not in dictionary:
                dictionary.append(word)

# construct
with open('./StopWordList/stop_words.txt', 'r') as f:
    dictionary = [l.strip() for l in f]

compare_to_list('./StopWordList/20k.txt')
compare_to_list('./StopWordList/google-10000-english-no-swears.txt')
compare_to_list('./StopWordList/google-10000-english-usa-no-swears-long.txt')
compare_to_list('./StopWordList/google-10000-english-usa-no-swears-medium.txt')
compare_to_list('./StopWordList/google-10000-english-usa-no-swears-short.txt')
compare_to_list('./StopWordList/google-10000-english-usa-no-swears.txt')
compare_to_list('./StopWordList/google-10000-english-usa.txt')
compare_to_list('./StopWordList/google-10000-english.txt')

with open('../../../public/stop_words.txt', 'w') as f:
    for item in dictionary:
        f.write("%s\n" % item)
