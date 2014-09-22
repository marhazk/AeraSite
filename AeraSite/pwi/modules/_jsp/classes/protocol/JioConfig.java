/*     */ package protocol;
/*     */ 
/*     */ import java.io.BufferedReader;
/*     */ import java.io.File;
/*     */ import java.io.IOException;
/*     */ import java.io.InputStreamReader;
/*     */ import java.io.PrintStream;
/*     */ import java.net.URI;
/*     */ import java.net.URL;
/*     */ import java.util.HashMap;
/*     */ 
/*     */ public class JioConfig
/*     */ {
/*  16 */   private static JioConfig instance = new JioConfig();
/*     */   private File JioConfigfile;
/*     */   private long mtime;
/*  18 */   private HashMap JioConfighash = new HashMap();
/*     */ 
/*  14 */   private String charset = new String("GBK");
/*     */ 
/*     */   private void parse(BufferedReader br)
/*     */     throws IOException
/*     */   {
/*  22 */     String section = null;
/*  23 */     HashMap sechash = new HashMap();
/*  24 */     this.JioConfighash.clear();
/*  25 */     while (br.ready())
/*     */     {
/*  27 */       String line = br.readLine().trim();
/*  28 */       if (line.length() != 0) {
/*  29 */         char c = line.charAt(0);
/*  30 */         if ((c != '#') && (c != ';'))
/*     */         {
/*  32 */           if (c == '[')
/*     */           {
/*  34 */             line = line.substring(1, line.indexOf(']')).trim();
/*  35 */             if (section != null)
/*     */             {
/*  37 */               this.JioConfighash.put(section, sechash);
/*  38 */               sechash = new HashMap();
/*     */             }
/*  40 */             section = line;
/*     */           }
/*     */           else
/*     */           {
/*  44 */             String[] key_value = line.split("=", 2);
/*  45 */             sechash.put(key_value[0].trim(), key_value[1].trim());
/*     */           }
/*     */         }
/*     */       }
/*     */     }
/*  48 */     if (section != null)
/*  49 */       this.JioConfighash.put(section, sechash);
/*     */   }
/*     */ 
/*     */   private void reload()
/*     */   {
/*     */     try
/*     */     {
/*  56 */       for (long last = this.JioConfigfile.lastModified(); last != this.mtime; last = this.JioConfigfile.lastModified())
/*     */       {
/*  58 */         this.mtime = last;
/*  59 */         URL url = this.JioConfigfile.toURI().toURL();
/*  60 */         BufferedReader br = new BufferedReader(new InputStreamReader(url.openStream(), this.charset));
/*  61 */         parse(br);
/*  62 */         br.close();
/*     */       }
/*     */     }
/*     */     catch (Exception e)
/*     */     {
/*  67 */       e.printStackTrace();
/*     */     }
/*     */   }
/*     */ 
/*     */   public synchronized String find(String section, String key)
/*     */   {
/*  73 */     HashMap sechash = (HashMap)this.JioConfighash.get(section);
/*  74 */     if (sechash != null)
/*     */     {
/*  76 */       String val = (String)sechash.get(key);
/*  77 */       if (val != null)
/*  78 */         return new String(val);
/*     */     }
/*  80 */     return new String();
/*     */   }
/*     */ 
/*     */   public synchronized void put(String section, String key, String val) {
/*  84 */     HashMap sechash = (HashMap)this.JioConfighash.get(section);
/*  85 */     if (null == sechash)
/*     */     {
/*  87 */       sechash = new HashMap();
/*  88 */       this.JioConfighash.put(section, sechash);
/*     */     }
/*  90 */     sechash.put(key, val);
/*     */   }
/*     */ 
/*     */   public static synchronized JioConfig GetInstance(String filename, String charset)
/*     */   {
/*  95 */     if (charset != null)
/*  96 */       instance.charset = charset;
/*  97 */     File file = new File(filename);
/*  98 */     if (file.isFile())
/*     */     {
/* 100 */       instance.JioConfigfile = file;
/* 101 */       instance.reload();
/*     */     }
/* 103 */     return instance;
/*     */   }
/*     */ 
/*     */   public static synchronized JioConfig GetInstance(URL url, String charset)
/*     */   {
/*     */     try
/*     */     {
/* 110 */       if (charset != null)
/* 111 */         instance.charset = charset;
/* 112 */       BufferedReader br = new BufferedReader(new InputStreamReader(url.openStream(), instance.charset));
/* 113 */       instance.parse(br);
/* 114 */       br.close();
/*     */     }
/*     */     catch (Exception e)
/*     */     {
/* 118 */       e.printStackTrace();
/*     */     }
/* 120 */     return instance;
/*     */   }
/*     */   public static synchronized JioConfig GetInstance() {
/* 123 */     return instance;
/*     */   }
/*     */ 
/*     */   public static void main(String[] args) {
/* 127 */     GetInstance(args[0], null);
/* 128 */     System.out.println(GetInstance().find(args[1], args[2]));
/*     */   }
/*     */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.JioConfig
 * JD-Core Version:    0.6.2
 */