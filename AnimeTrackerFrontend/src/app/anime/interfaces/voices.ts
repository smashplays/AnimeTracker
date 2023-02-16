export interface Voices {
  data: [
    {
      language: string;
      person: {
        images:{
            jpg:{
                image_url: string;
            }
        }
        name: string;
      }
    }
  ];
}
