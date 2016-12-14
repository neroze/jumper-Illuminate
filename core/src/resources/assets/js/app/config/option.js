var Option = {
   compulsory_trainings:[
            'First Aid Training',
            'CPR Training',
            'Asthma / Anaphylaxis',
            'Child Protection',
   ],
   traning_titles:[
   			{value:'First Aid Training',data:'First Aid Training'},
   			{value:'CPR Training', data:'CPR Training'},
   			{value:'Asthma / Anaphylaxis',data:'Asthma / Anaphylaxis'},
   			{value:'CPR Training',data:'CPR Training'},
   			{value:'Child Protection',data:'Child Protection'},
   			{value:'Emergancy Evacuation Drill',data:'Emergancy Evacuation Drill'},
   			{value:'Programming',data:'Programming'},
   			{value:'Food Handling',data:'Food Handling'},
   			{value:'Sustainability',data:'Sustainability'},
   			{value:'Road Safety',data:'Road Safety'},
   			{value:'Car restraint / seat belt check',data:'Car restraint / seat belt check'},
   			{value:'CCB Compliance',data:'CCB Compliance'},
   			{value:'Roles & Responsibility',data:'Roles & Responsibility'},
   			{value:'Code of Conduct/ Philosophy',data:'Code of Conduct/ Philosophy'},
   			{value:'Timesheet Training',data:'Timesheet Training'},
   			{value:'Induction Training',data:'Induction Training'},
   			{value:'Sun Smart',data:'Sun Smart'},
   			{value:'Fire Essential Check',data:'Fire Essential Check'},
   			{value:'Risk Assessment Check',data:'Risk Assessment Check'},
   			{value:'Police Check',data:'Police Check'},
   			{value:'Home Safety',data:'Home Safety'},
   			{value:'Yearly compliance check',data:'Yearly compliance check'},
   			{value:'Agreement',data:'Agreement'},
   			{value:'History Check (wwc)',data:'History Check (wwc)'},
   			{value:'Medical Clearance',data:'Medical Clearance'},
   			{value:'Public Liability Insurance',data:'Public Liability Insurance'},
   			{value:'Identification',data:'Identification'}
   ]
   ,field_visit_type :[
      {value:"Initial Home Visit",data:1}
      ,{value:"Regular Home Visit",data:2}
      ,{value:"Monthly Home Visit",data:2}
   ]
   ,field_visit_status :[
      {value:1, title:"Waiting for response"}
      ,{value:2, title:"Re Visit Required"}
      ,{value:3, title:"TBA"}
      ,{value:4, title:"Completed"}
   ]
   ,review_question_sections:["Other","Details","Kitchen","Outdoors / Balconies","Designed Care Area","Bed Room / Lounge","Bath Room / Toilet / Laoundry"]
};

module.exports = Option;