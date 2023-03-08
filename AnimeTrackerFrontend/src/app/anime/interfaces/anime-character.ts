export interface AnimeCharacter {
  data: [
    {
      anime: {
        mal_id: string;
        images: {
          jpg: {
            image_url: string;
          };
        };
        title: string;
      };
    }
  ];
}
