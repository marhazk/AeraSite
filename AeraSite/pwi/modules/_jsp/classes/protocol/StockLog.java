/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class StockLog extends Rpc.Data
/*    */ {
/*    */   public int tid;
/*    */   public int time;
/*    */   public short result;
/*    */   public short volume;
/*    */   public int cost;
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 22 */     os.marshal(this.tid);
/* 23 */     os.marshal(this.time);
/* 24 */     os.marshal(this.result);
/* 25 */     os.marshal(this.volume);
/* 26 */     os.marshal(this.cost);
/* 27 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 32 */     this.tid = os.unmarshal_int();
/* 33 */     this.time = os.unmarshal_int();
/* 34 */     this.result = os.unmarshal_short();
/* 35 */     this.volume = os.unmarshal_short();
/* 36 */     this.cost = os.unmarshal_int();
/* 37 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 44 */       return (StockLog)super.clone();
/*    */     }
/*    */     catch (Exception e) {
/*    */     }
/* 48 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.StockLog
 * JD-Core Version:    0.6.2
 */