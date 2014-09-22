/*     */ import com.goldhuman.Common.Conf;
/*     */ import com.goldhuman.Common.Octets;
/*     */ import com.goldhuman.Common.ThreadPool;
/*     */ import com.goldhuman.IO.PollIO;
/*     */ import com.goldhuman.IO.Protocol.Protocol;
/*     */ import com.goldhuman.service.GMServiceImpl;
/*     */ import com.goldhuman.util.PresentGoodsId;
/*     */ import java.io.IOException;
/*     */ import java.io.PrintStream;
/*     */ import java.net.URL;
/*     */ import javax.servlet.ServletException;
/*     */ import javax.servlet.http.HttpServlet;
/*     */ import javax.servlet.http.HttpServletRequest;
/*     */ import javax.servlet.http.HttpServletResponse;
/*     */ import org.apache.commons.logging.Log;
/*     */ import org.apache.commons.logging.LogFactory;
/*     */ import protocol.ClientManager;
/*     */ import protocol.DeliveryClientManager;
/*     */ import protocol.IwebVersionManager;
/*     */ 
/*     */ public class StartupServlet extends HttpServlet
/*     */ {
/*  37 */   private static final Log log = LogFactory.getLog(StartupServlet.class);
/*     */ 
/*     */   public void destroy()
/*     */   {
/*  50 */     super.destroy();
/*     */   }
/*     */ 
/*     */   public void doGet(HttpServletRequest request, HttpServletResponse response)
/*     */     throws ServletException, IOException
/*     */   {
/*     */   }
/*     */ 
/*     */   public void doPost(HttpServletRequest request, HttpServletResponse response)
/*     */     throws ServletException, IOException
/*     */   {
/*     */   }
/*     */ 
/*     */   public void init()
/*     */     throws ServletException
/*     */   {
/*  93 */     Conf conf = Conf.GetInstance("/etc/iweb.conf", null);
/*  94 */     Octets.setDefaultCharset("UTF-16LE");
/*  95 */     GMServiceImpl gmi = new GMServiceImpl();
/*     */     try {
/*  97 */       Class.forName("protocol.DeliveryDB");
/*  98 */       Runtime.getRuntime().exec("/bin/mkdir -p /var/spool/moverole/incoming");
/*  99 */       Runtime.getRuntime().exec("/bin/mkdir -p /var/spool/moverole/outcoming");
/* 100 */       Runtime.getRuntime().exec("/bin/mkdir -p /var/spool/rolexml/incoming");
/* 101 */       Runtime.getRuntime().exec("/bin/mkdir -p /var/spool/rolexml/outcoming"); } catch (Exception ex) {
/* 102 */       ex.printStackTrace();
/*     */     }try {
/* 104 */       boolean pidon = conf.find("iweb", "pidon").equals("true");
/* 105 */       if (pidon) {
/* 106 */         String pkey = "0123456789123456";
/* 107 */         URL presentgoodsFile = StartupServlet.class.getResource("/presentgoodsid.txt");
/* 108 */         PresentGoodsId.getInstance(pkey, presentgoodsFile);
/* 109 */         System.out.println("ids=" + PresentGoodsId.getInstance().toString()); } else {
/* 110 */         PresentGoodsId.getInstance(null, null);
/*     */       } } catch (Exception e) { e.printStackTrace(); }
/* 112 */     IwebVersionManager.getInstance();
/*     */     try {
/* 114 */       Protocol.Client(ClientManager.GetInstance());
/*     */     } catch (Exception e) {
/* 116 */       System.out.println("connect Game  error");
/* 117 */       e.printStackTrace();
/*     */     }
/*     */     try {
/* 120 */       Protocol.Client(DeliveryClientManager.GetInstance());
/*     */     } catch (Exception e) {
/* 122 */       System.out.println("connect Delivery error");
/* 123 */       e.printStackTrace();
/*     */     }
/* 125 */     ThreadPool.AddTask(PollIO.GetTask());
/* 126 */     log.info("iweb web service startup!");
/*     */   }
/*     */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     StartupServlet
 * JD-Core Version:    0.6.2
 */