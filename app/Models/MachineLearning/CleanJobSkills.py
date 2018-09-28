import sys,csv,re


# format: job_title, job_description, category, skills/requirement, industry, prefered_years_experience,
container = []


#Sample Data similar-skills-28935-unique-skills-QueryResult
with open('./Data/similar-skills-28935-unique-skills-QueryResult.csv', 'rt') as f:
    next(f)
    reader = csv.reader(f, delimiter=',')
    for row in reader:
        for word in row:
            words = word.split(' ')
            for object in words:
                if object not in container:
                    container.append(object)

with open('../../../public/skill_words.txt', 'w') as f:
    for item in container:
        f.write("%s\n" % item)
