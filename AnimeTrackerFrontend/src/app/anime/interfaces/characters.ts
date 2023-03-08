export interface Characters {
  data: [
    {
      character: {
        mal_id: number;
        images: {
          jpg: {
            image_url: string;
          };
        };
        name: string;
      };
    }
  ];
}
