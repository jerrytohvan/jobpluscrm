import csv,re

def retrieve_years_of_experience(desc):
    word = -1
    years_array = [desc.rfind('years of'),desc.rfind('years of experience'), desc.rfind('years of work'),desc.rfind('years of professional'),desc.rfind('years of total experience')]
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


# format: job_title, job_description, category, skills/requirement, industry, prefered_years_experience,
container = []
container.append(['job_title', 'job_description', 'category', 'skills', 'industry', 'prefered_years_experience'])


#Sample Data dice_com-job_us_sample
with open('./Data/dice_com-job_us_sample.csv', 'rb') as f:
    next(f)
    reader = csv.reader(f, delimiter=',')
    for row in reader:
        # word = -1
        # years_array = [row[3].rfind('years of experience'), row[3].rfind('years of work'),row[3].rfind('years of professional'),row[3].rfind('years of total experience')]
        # years_experience_index = max(years_array)
        # if years_experience_index != -1:
        #     substring = row[3][years_experience_index-10:years_experience_index+10]
        #     word = -1 if not substring else (re.findall(r'\d+', substring))
        #     if word != -1 and len(word) > 1:
        #         word = word[-1]
        # if isinstance(word, list):
        #     word = "".join(map(str, word))
        word = retrieve_years_of_experience(row[3])
        container.append([row[6], row[3], '', row[10], '', word])

#Sample Data from GOOGLE
# with open('./Data/job_skills.csv', 'rb') as f:
#     next(f)
#     reader = csv.reader(f, delimiter=',')
#     for row in reader:
#         word = retrieve_years_of_experience(row[5])
#         print(word)
#         container.append([row[1], row[4], row[2], row[6], '', word])

#Sample Data from naukri_com-job-sample
with open('./Data/naukri_com-job-sample.csv', 'rb') as f:
    next(f)
    reader = csv.reader(f, delimiter=',')
    for row in reader:
        word = row[2][row[2].rfind('yrs')-10:row[2].rfind('yrs')+10]
        print(word)
        container.append([row[7], row[5], '', row[1] + row[12], row[4], word])



#write to csv
with open("./Data/data_samples.csv","wb") as doc:
    csvWriter = csv.writer(doc,delimiter=',')
    csvWriter.writerows(container)
