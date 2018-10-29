import sys,csv,re


# format: job_title, job_description, category, skills/requirement, industry, prefered_years_experience,
container = []


#Sample Data similar-skills-28935-unique-skills-QueryResult
# print 'Loading from Data World'
stop_words  = open('./Data/stop_words.txt', 'r').read().split('\n')
with open('./Data/similar-skills-28935-unique-skills-QueryResult.csv', 'rt') as f:
    next(f)
    reader = csv.reader(f, delimiter=',')
    for row in reader:
        for word in row:
            words = word.split(' ')
            for object in words:
                if (object not in container) and (object not in stop_words):
                    container.append(object)

print 'Loading from linkedin crawler'
with open('./Data/linkedin_crawled.txt', 'r') as f:
    store = [l.strip() for l in f]
    for word in store:
        words = word.split(' ')
        for object in words:
            if (object not in container) and (object not in stop_words):
                container.append(object)

#train from dice.com (tech skills)
print 'Loading from dice.com'
with open('./Data/dice_com-job_us_skills.csv', 'rb') as f:
    next(f)
    reader = csv.reader(f, delimiter=',')
    for row in reader:
        # words = row[10].split(',')
        words = re.split(r'[\s,;/]+', row[10])
        for object in words:
            e = re.sub('[!@#$.():*+"]', '', object.strip())
            if (e not in container) and (e not in stop_words):
                container.append(e)

print 'writing to file'
with open('../../../public/skill_words.txt', 'w') as f:
    for item in container:
        f.write("%s\n" % item)
