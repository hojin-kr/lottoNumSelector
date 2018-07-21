
recommend <- function(numbers){
  x<-1:45
  if(numbers == ""){
    result<- sample(x,6,replace=F)
    
  }else{
  number_split <- strsplit(numbers,split = ",")
  check<-as.numeric(unlist(number_split))
  random <- sample(x[-check],6-length(check),replace=F)
  result <- c(check,random) # 입력값과 랜덤값 합치기
  }

  result<- paste0(result[1],",",result[2],",",result[3],",",result[4],",",result[5],",",result[6])
  return (result)
}

args <- commandArgs(trailingOnly =T)
recommend(args[1])
