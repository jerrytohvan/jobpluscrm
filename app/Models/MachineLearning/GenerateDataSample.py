import sys,csv,re

def retrieve_years_of_experience(desc):
    word = -1
    years_array = [desc.rfind('years of'),desc.rfind('years of experience'),desc.rfind('year of'), desc.rfind('years of work'),desc.rfind('years of professional'),desc.rfind('years of total experience')]
    for x in years_array:
        if x != -1:
            x = desc[x-10:x+10]
    years_experience_index = max(years_array)
    if years_experience_index != -1:
        substring = desc[years_experience_index-10:years_experience_index+10]
        word = -1 if not substring else (re.findall(r'\d+', substring))
        if word != -1 and len(word) > 1:
            word = word[-1]
    if isinstance(word, list):
        word = "".join(map(str, word))
    return word

if len(sys.argv) > 1:
    descParameter = str(sys.argv[1])
    print(retrieve_years_of_experience(descParameter))
    sys.exit()
# format: job_title, job_description, category, skills/requirement, industry, prefered_years_experience,
container = []
container.append(['job_title', 'job_description', 'category', 'skills', 'industry', 'prefered_years_experience'])


#Sample Data dice_com-job_us_sample
with open('./Data/dice_com-job_us_sample.csv', 'rb') as f:
    next(f)
    reader = csv.reader(f, delimiter=',')
    for row in reader:
        if row[6]:
            word = retrieve_years_of_experience(row[3])
            container.append([row[6], row[3], '', row[10], '', word])
# #Sample Data from GOOGLE
# with open('./Data/job_skills.csv', 'rb') as f:
#     next(f)
#     reader = csv.reader(f, delimiter=',')
#     for row in reader:
#         if row[1]:
#             word = retrieve_years_of_experience(row[5])
#             container.append([row[1], row[4], row[2], row[6], '', word])

# #Sample Data from naukri_com-job-sample
# with open('./Data/naukri_com-job_sample.csv', 'rb') as f:
#     next(f)
#     reader = csv.reader(f, delimiter=',')
#     for row in reader:
#         if row[7]:
#             word = -1 if not row[2] else (re.findall(r'\d+', row[2]))
#             if word != -1 and len(word) > 1:
#                 word = word[0]
#             container.append([row[7], row[4], '', row[1] + row[12], row[4], word])

# #Sample Data from reed_uk
# with open('./Data/reed_uk.csv', 'rb') as f:
#     next(f)
#     reader = csv.reader(f, delimiter=',')
#     for row in reader:
#         if row[7]:
#             word = retrieve_years_of_experience(row[5])
#             cat =  row[0][0:row[0].rfind(' ')]
#             container.append([row[7], row[5], cat ,row[6] + row[5] , cat, word])

#
# #Sample Data from data_job_posts
# with open('./Data/data_job_posts.csv', 'rb') as f:
#     next(f)
#     reader = csv.reader(f, delimiter=',')
#     for row in reader:
#         if row[2]:
#             word = retrieve_years_of_experience(row[13])
#             container.append([row[2], row[11], '' ,row[12] + row[13] , '', word])

#write to csv
# with open("../../../storage/app/Data/data_samples.csv","wb") as doc:
with open("../../../public/data_samples.csv","wb") as doc:

    csvWriter = csv.writer(doc,delimiter=',')
    csvWriter.writerows(container)
